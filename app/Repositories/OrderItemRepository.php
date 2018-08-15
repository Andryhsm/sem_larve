<?php

namespace App\Repositories;


use App\Interfaces\OrderItemAttributeInterface;
use App\Interfaces\OrderItemCouponInterface;
use App\Interfaces\OrderItemRepositoryInterface;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderStatusHistory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cookie;

class OrderItemRepository implements OrderItemRepositoryInterface
{
	protected $order_item_attribute_repository;
	protected $order_item_coupon_repository;

	public function __construct(OrderItemAttributeInterface $order_item_attribute, OrderItemCouponInterface $order_item_coupon)
	{
		$this->order_item_attribute_repository = $order_item_attribute;
		$this->order_item_coupon_repository = $order_item_coupon;
	}

	public function saveItem($cart_item, $order)
	{
		$order_item = new OrderItem();
		$order_item->product_id = $cart_item->getId();
		$order_item->product_name = $cart_item->getName();
		$order_item->product_sku = $cart_item->getSku();
		$order_item->quantity = $cart_item->getQuantity();
		$order_item->price = $cart_item->getBestPrice();
		$order_item->discount = 0;
		$order_item->final_price = $cart_item->getTotal();
		$order_item->attribute_sku = '';
		$order_item->attribute_price = 0;
		$order_item->tax = 0;
		$order_item->radius = $cart_item->getRadius();
		$order_item->zip_code = $cart_item->getPostalCode();
		/*$order_item->radius = (Cookie::has('distance')) ? Cookie::get('distance') : null;
		$order_item->zip_code = (Cookie::has('zip_code')) ? Cookie::get('zip_code') : null;*/
		$order_item->brand_id = $cart_item->getBrand();
		$order_item->order_status_id = '1';
		$order_item->product_url = (!empty($cart_item->getProduct()) && !empty($cart_item->getProduct()->affiliate[0]))? $cart_item->getProduct()->affiliate[0]->product_url : null;
		$order->orderItems()->save($order_item);

		foreach ($cart_item->getAttributes() as $cart_item_attribute) {
			$this->order_item_attribute_repository->saveAttribute($cart_item_attribute, $order_item);
		}
		return $order_item;
	}

    public function ByStatus($status_id,$brands)
    {
		$status_id = !is_array($status_id)? [$status_id]:$status_id;
        return OrderItem::with(['brand.stores', 'product', 'attributes','itemRequest','coupon'])->whereIn('order_status_id',$status_id)->whereIn('brand_id', $brands)->get();
    }

    public function updateStatus($status_id, $order_item_id)
    {
        $order_item = OrderItem::find($order_item_id);
        $order_item->order_status_id = $status_id;
        $order_item->save();
    }

	public function getItemByStatus($status_id)
	{
		return OrderItem::with(['brand.stores', 'product', 'attributes','itemRequest.user.store'])->whereOrderStatusId($status_id)->get();
	}

	public function getPendingItemsByMerchant($brands, $user_id)
	{
		$items = OrderItem::whereNotExists(function($query) use ($user_id)
		{
			$query->select('*')
				->from('order_item_request')
				->whereRaw('order_item_request.item_id= order_item.order_item_id')
				->where('order_item_request.merchant_id','=',$user_id);
		})
			->with(['brand','brand.stores', 'product', 'attributes'])
			->whereIn('order_status_id',[OrderItem::ORDER_STATUS_ORDERED,OrderItem::ORDER_STATUS_REPLIED])
			->whereIn('brand_id', $brands)
			->get();
		return $items;
	}

	public function getWaitingItemsByMerchant($brands, $user_id)
	{
		$items = OrderItem::whereHas('itemRequest',function($query) use($user_id){
			$query->where('merchant_id',$user_id);
			$query->where('is_added_by','merchant');
		})
			->with(['brand','brand.stores', 'product', 'attributes','itemRequest'=>function($query) use($user_id){
				$query->where('merchant_id',$user_id);
				$query->where('is_added_by',"merchant");
			},'coupon'])
			->whereIn('order_status_id',[OrderItem::ORDER_STATUS_REPLIED,OrderItem::ORDER_STATUS_SELECTED])
			->whereIn('brand_id', $brands)
			->get();
		return $items;
	}

	//commande finished -- gagné par le commerçant
	public function getEarnedItemsByMerchant($brands, $user_id)
	{
		$items = OrderItem::whereHas('itemRequest',function($query) use($user_id){
			$query->where('merchant_id',$user_id);
			$query->where('is_added_by','customer');
		})
			->with(['brand','brand.stores', 'product', 'attributes','itemRequest'=>function($query) use($user_id){
				$query->where('merchant_id',$user_id);
				$query->where('is_added_by',"customer");
			},'coupon'])
			->where('order_status_id',OrderItem::ORDER_STATUS_FINISHED)
			->whereIn('brand_id', $brands)
			->get();
		return $items;
	}

	public function itemByStatusAndUser($status_id, $user_id)
	{
		$status_id = is_array($status_id) ? $status_id : [$status_id];
		$items = OrderItem::whereHas('order',function($query) use($user_id){
			$query->where('user_id',$user_id);
		})
			->with(['brand','brand.stores', 'product', 'attributes','itemRequest','itemRequest.user.store','itemRequest.merchant.store'])
			->whereIn('order_status_id',$status_id)
			->get();
		return $items;
	}
	public function itemByStatusFinishedAndUser($status_id, $user_id)
	{
		$status_id = is_array($status_id) ? $status_id : [$status_id];
		$items = OrderItem::whereHas('order',function($query) use($user_id){
			$query->where('user_id',$user_id);
		})
			->with(['order','brand','brand.stores', 'product', 'attributes','itemRequest.user.store'])
			->whereIn('order_status_id',$status_id)
			->get();
		return $items;
	}

	public function getChoosenItemByUser($user_id)
	{
		$items = OrderItem::whereHas('order',function($query) use($user_id){
			$query->where('user_id',$user_id);
		})->whereHas('itemRequest',function($query) use($user_id){
			$query->where('customer_id',$user_id);
			$query->where('is_added_by','customer');
			$query->where('is_booked','0');
		})
			->with(['brand','brand.stores', 'product', 'attributes','itemRequest'=>function($query) use($user_id){
				$query->where('customer_id',$user_id);
				$query->where('is_added_by',"customer");
				$query->where('is_booked','0');
			},'coupon'])
			->whereIn('order_status_id',[OrderItem::ORDER_STATUS_REPLIED,OrderItem::ORDER_STATUS_SELECTED])
			->get();
		return $items;
	}

	public function getBookedItemByUser($user_id)
	{
		$items = OrderItem::whereHas('order',function($query) use($user_id){
			$query->where('user_id',$user_id);
		})->whereHas('itemRequest',function($query) use($user_id){
			$query->where('customer_id',$user_id);
			$query->where('is_added_by','customer');
			$query->where(function ($q) {
				$q->where('is_booked', '1');
				$q->orWhere('is_canceled', '1');
			});
		})
			->with(['brand','brand.stores', 'product', 'attributes','itemRequest'=>function($query) use($user_id){
				$query->where('customer_id',$user_id);
				$query->where('is_added_by',"customer");
				$query->where(function ($q) {
					$q->where('is_booked', '1');
					$q->orWhere('is_canceled', '1');
				});
			},'coupon'])
			->whereIn('order_status_id',[OrderItem::ORDER_STATUS_FINISHED,OrderItem::ORDER_STATUS_CANCELED])
			->get();
		return $items;
	}

	public function getAllInvoiceItems()
	{
		return OrderItem::where('order_status_id',OrderItem::ORDER_STATUS_FINISHED)->get();
	}

	public function getAllBookedItems()
	{
		$items = OrderItem::whereHas('itemRequest',function($query){
			$query->where('is_added_by','customer');
			$query->where('is_booked','1');
		})
			->with(['brand.stores', 'product','itemRequest'=>function($query){
				$query->where('is_added_by',"customer");
				$query->where('is_booked','1');
			},'itemRequest.merchant','invoiceItem','invoiceItem.invoice'])
			->whereIn('order_status_id',[OrderItem::ORDER_STATUS_FINISHED])
			->get();
		return $items;
	}
	public function getBookedItemById($id)
	{
		$item = OrderItem::whereHas('itemRequest',function($query){
			$query->where('is_added_by','customer');
			$query->where('is_booked','1');
		})
			->with(['order', 'product','itemRequest'=>function($query){
				$query->where('is_added_by',"customer");
				$query->where('is_booked','1');
			},'itemRequest.merchant','itemRequest.store','itemRequest.merchant.store','invoiceItem','invoiceItem.invoice'])
			->where('order_item_id',$id)
			->whereIn('order_status_id',[OrderItem::ORDER_STATUS_FINISHED])
			->first();
		return $item;
	}
}