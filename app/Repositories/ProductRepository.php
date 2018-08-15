<?php
namespace App\Repositories;

use App\AttributeSet;
use App\Interfaces\ProductRepositoryInterface;
use App\Models\AffiliateProduct;
use App\Models\ProductTranslation;
use App\Product;
use App\ProductAttributeValue;
use App\ProductImage;
use App\Url;
use Illuminate\Support\Facades\Session;
use App\Models\ProductVideo;

class ProductRepository implements ProductRepositoryInterface
{
    protected $model;
    protected $modelAffiliate;

    public function __construct(Product $product, AffiliateProduct $affiliate)
    {
        $this->model = $product;
        $this->modelAffiliate = $affiliate;
    }

    public function save($input)
    {
        try {
           $this->model->sku = $input['serial_number'];
            $this->model->brand_id = $input['brand_id'];
            $this->model->is_active = $input['is_active'];
            $this->model->original_price = $input['original_price'];
            $this->model->best_price = $input['best_price'];
            $this->model->attribute_set_id = $input['attribute_set'];
            $this->model->responsible = $input['responsible'];
            $this->model->question_note = $input['question_note'];
            $this->model->created_by = auth()->guard('admin')->user()->admin_id;
            $this->model->save(); 

            if (!empty($input['en_product_name']) || !empty($input['en_summary']) || !empty($input['en_description']) || !empty($input['en_title']) ||
				!empty($input['en_meta_description']) || !empty($input['en_meta_keywords']) || !empty($input['en_og_title']) || !empty($input['en_og_description'])) {
                $product_translation = new ProductTranslation();
                $product_translation->product_name = $input['en_product_name'];
                $product_translation->summary = $input['en_summary'];
                $product_translation->description = $input['en_description'];
                $product_translation->meta_title = $input['en_title'];
                $product_translation->meta_description = $input['en_meta_description'];
                $product_translation->meta_keywords = $input['en_meta_keywords'];
                $product_translation->og_title = $input['en_og_title'];
                $product_translation->og_description = $input['en_og_description'];
                $product_translation->language_id = '1';
                $this->model->translation()->save($product_translation);
            }

            if (!empty($input['fr_product_name']) || !empty($input['fr_summary']) || !empty($input['fr_description']) || !empty($input['fr_title']) ||
				!empty($input['fr_meta_description']) || !empty($input['fr_meta_keywords']) || !empty($input['fr_og_title']) || !empty($input['fr_og_description'])) {
                $product_translation = new ProductTranslation();
                $product_translation->product_name = $input['fr_product_name'];
                $product_translation->summary = $input['fr_summary'];
                $product_translation->description = $input['fr_description'];
				$product_translation->meta_title = $input['fr_title'];
				$product_translation->meta_description = $input['fr_meta_description'];
				$product_translation->meta_keywords = $input['fr_meta_keywords'];
				$product_translation->og_title = $input['fr_og_title'];
				$product_translation->og_description = $input['fr_og_description'];
                $product_translation->language_id = '2';
                $this->model->translation()->save($product_translation);
            }
            //insert attributes
            if (isset($input['attributes']) && count($input['attributes']) > 0) {
                foreach ($input['attributes'] as $attribute_id => $options) {
                    foreach ($options as $option) {
                        $product_attribute_value = new ProductAttributeValue();
                        $product_attribute_value->product_id = $this->model->product_id;
                        $product_attribute_value->attribute_id = $attribute_id;
                        $product_attribute_value->attribute_option_id = $option;
                        $product_attribute_value->option_value = '';
                        $product_attribute_value->price = 0;
                        $product_attribute_value->per_quantity = '0';
                        $product_attribute_value->sort_order = 0;
                        $product_attribute_value->save();
                    }
                }
            }


            //insert product category data
            if (isset($input['categories_id'])) {
                $categories = explode(',', $input['categories_id']);
                foreach ($categories as $category_id) {
                    $this->model->categories()->attach($category_id);
                }
            }

            //insert product tag data
            if (isset($input['product_tag'])) {
                $tags = explode(',', $input['product_tag']);
                foreach ($tags as $tag_id) {
                    $this->model->tags()->attach($tag_id);
                }
            }


            //store product image
            $product_images = Session::has('product_images') ? Session::get('product_images') : [];

            //Suppression de session image après modification
            if(Session::has('product_images')){
                Session::forget('product_images');
            }

            foreach ($product_images as $index=>$image) {
                $product_image = new ProductImage();
                $product_image->product_id = $this->model->product_id;
                $product_image->image_name = $image;
                $product_image->sort_order = 0;
                $product_image->alt = (!empty($input['image_alt']) && isset($input['image_alt'][$index])) ? $input['image_alt'][$index] : '';
                $product_image->title = (!empty($input['image_title']) && isset($input['image_title'][$index])) ? $input['image_title'][$index] : '';
                $product_image->sort_order = (!empty($input['image_sort_order']) && isset($input['image_sort_order'][$index])) ? $input['image_sort_order'][$index] : '';
                $product_image->save();
            }

            //insert product video
            foreach ($input['videos'] as $video) {
                if (empty($video['value'])) {
                    continue;
                }
                $product_video = new ProductVideo();
                $product_video->video_title = $video['name'];
                $product_video->video_url = $video['value'];
                $product_video->product_id = $this->model->product_id;
                $product_video->save();
            }
            //insert url data
            $url = new Url();
            $url->request_url = $input['product_url'];
            $url->target_url = $input['product_url'];
            $url->type = '2';
            $url->target_id = $this->model->product_id;
            $url->save();

            //save affiliate product
            /*$affiliate_product=$input['searchproduct'];
            foreach($affiliate_product as $index=>$product){
                if(isset($product['select']) && $product['select']=='1'){
                    $image_name='';
                    //$image_name=$this->ImageUpload('file');
                    $affiliate=New AffiliateProduct();
                    $affiliate->product_id=$this->model->product_id;
                    $affiliate->product_name=(isset($product['name']))?$product['name']:'';
                    $affiliate->price=str_replace('$',"",$product['price']);
                    $affiliate->product_url=$product['url'];
                    $affiliate->product_image=$image_name;
                    $affiliate->save();
                }
            }*/
            return $this->model;
        } catch (\Exception $e) {
            dd($e->getMessage());
            return false;
        }
    }

    public function getAffiliates($product_id)
    {
        return $this->modelAffiliate->where('product_id', $product_id)->orderBy('product_id', 'desc')->get();
    }

    public function updateById($product_id, $input)
    {
        $product = $this->model->findOrNew($product_id);
        $product->brand_id = $input['brand_id'];
        $product->sku = $input['serial_number'];
        $product->is_active = $input['is_active'];
        $product->original_price = $input['original_price'];
        $product->best_price = $input['best_price'];
        $product->responsible = $input['responsible'];
        $product->question_note = $input['question_note'];
        $product->modified_by = auth()->guard('admin')->user()->admin_id;
        $product->save();


        if (!empty($input['en_product_name']) || !empty($input['en_summary']) || !empty($input['en_description']) || !empty($input['en_title']) ||
			!empty($input['en_meta_description']) || !empty($input['en_meta_keywords']) || !empty($input['en_og_title']) || !empty($input['en_og_description'])) {
            ProductTranslation::updateOrCreate(['product_id' => $product_id, 'language_id' => '1'],
                [
                    'product_name' => $input['en_product_name'],
                    'summary' => $input['en_summary'],
                    'description' => $input['en_description'],
					'meta_title'=>$input['en_title'],
					'meta_description'=>$input['en_meta_description'],
					'meta_keywords'=>$input['en_meta_keywords'],
					'og_title'=>$input['en_og_title'],
					'og_description'=>$input['en_og_description'],
                ]
            );
        }

        if (!empty($input['fr_product_name']) || !empty($input['fr_summary']) || !empty($input['fr_description']) || !empty($input['fr_title']) ||
			!empty($input['fr_meta_description']) || !empty($input['fr_meta_keywords']) || !empty($input['fr_og_title']) || !empty($input['fr_og_description'])) {
            ProductTranslation::updateOrCreate(['product_id' => $product_id, 'language_id' => '2'],
                [
                    'product_name' => $input['fr_product_name'],
                    'summary' => $input['fr_summary'],
                    'description' => $input['fr_description'],
					'meta_title'=>$input['fr_title'],
					'meta_description'=>$input['fr_meta_description'],
					'meta_keywords'=>$input['fr_meta_keywords'],
					'og_title'=>$input['fr_og_title'],
					'og_description'=>$input['fr_og_description'],
				]
            );
        }
        //insert attributes
        $new_attribute_option = [];
        $old_attribute_option = isset($input['old_attribute_option_id']) ? explode(',', $input['old_attribute_option_id']) : [];
        if (isset($input['attributes']) && count($input['attributes']) > 0) {
            foreach ($input['attributes'] as $attribute_id => $options) {
                foreach ($options as $option) {
                    $available_options = ProductAttributeValue::where('attribute_id', $attribute_id)->where('attribute_option_id', $option)->where('product_id',$product_id)->first();
                    $new_attribute_option[] = $option;
                    if (isset($available_options) && count($available_options) > 0) {
                        continue;
                    }
                    $product_attribute_value = new ProductAttributeValue();
                    $product_attribute_value->product_id = $product->product_id;
                    $product_attribute_value->attribute_id = $attribute_id;
                    $product_attribute_value->attribute_option_id = $option;
                    $product_attribute_value->option_value = '';
                    $product_attribute_value->price = 0;
                    $product_attribute_value->per_quantity = '0';
                    $product_attribute_value->sort_order = 0;
                    $product_attribute_value->save();
                }
            }
        }

        $removable_option = array_diff($old_attribute_option, $new_attribute_option);

        if (count($removable_option) > 0) {
            ProductAttributeValue::whereIn('attribute_option_id', $removable_option)
                ->where('product_id', $product->product_id)
                ->delete();
        }


        $product->categories()->detach();
        //insert product category data
        if (isset($input['categories_id'])) {
            $categories = explode(',', $input['categories_id']);
            foreach ($categories as $category_id) {
                $product->categories()->attach($category_id);
            }
        }

        $product->tags()->detach();
        //insert product tag data
        if (isset($input['product_tag'])) {
            $tags = explode(',', $input['product_tag']);
            foreach ($tags as $tag_id) {
                $product->tags()->attach($tag_id);
            }
        }

        //store product image

        //Suppression des image de notre produit
        $product_image = new ProductImage();
        $product_image->where('product_id', $product->product_id)->delete();


        $product_images = Session::has('product_images') ? Session::get('product_images') : [];

        //Suppression de session image après modification
        if(Session::has('product_images')){
            Session::forget('product_images');
        }

        foreach ($product_images as $index=>$image) {
            $product_image = new ProductImage();
            $product_image->product_id = $product->product_id;
            $product_image->image_name = $image;
            $product_image->sort_order = 0;
            //	$product_image->title = $product->product_name;
            //dd($product_images);
			$product_image->alt = (!empty($input['image_alt']) && isset($input['image_alt'][$index])) ? $input['image_alt'][$index] : '';
			$product_image->title = (!empty($input['image_title']) && isset($input['image_title'][$index])) ? $input['image_title'][$index] : '';
			$product_image->sort_order = (!empty($input['image_sort_order']) && isset($input['image_sort_order'][$index])) ? $input['image_sort_order'][$index] : '';
			$product_image->save();
        }
         //dd($input);

        //On le commente pour que notre enregistrement se fait à partir du session
      /*  if(!empty($input['product_image_id'])){
        	foreach ($input['product_image_id'] as $index=>$product_image_id){
				$product_image = ProductImage::findOrNew($product_image_id);
				$product_image->alt = (!empty($input['image_alt']) && isset($input['image_alt'][$index])) ? $input['image_alt'][$index] : '';
				$product_image->title = (!empty($input['image_title']) && isset($input['image_title'][$index])) ? $input['image_title'][$index] : '';
				$product_image->sort_order = (!empty($input['image_sort_order']) && isset($input['image_sort_order'][$index])) ? $input['image_sort_order'][$index] : '';
				$product_image->save();
			}
		}*/

        //update product video
        $this->deleteVideoById($product_id);
        //dd($input);
        foreach ($input['videos'] as $video) {
            if (empty($video['value'])) {
                continue;
            }
            $product_video = New ProductVideo();
            $product_video->product_id = $product_id;
            $product_video->video_title = $video['name'];
            $product_video->video_url = $video['value'];
            $product_video->save();
        }

        $url = Url::findOrNew(isset($input['url_id']) ? $input['url_id'] : 0);
        $url->request_url = $input['product_url'];
        $url->target_url = $input['product_url'];
        $url->type = '2';
        $url->target_id = $product->product_id;
        $url->save();

        return $product;

    }

    public function getById($product_id)
    {
        return $this->model->with('english', 'french', 'admin', 'url', 'images','brand')->where('product_id', $product_id)->first();
    }

    public function getAll()
    {
        return $this->model->with('english', 'french', 'admin', 'tags','brand')->orderBy('product_id', 'desc')->get();
    }

    public function getFilterProduct($param)
    {
        return Product::draw($param)->with('english', 'french', 'admin', 'tags')->get();
    }

    public function getFilterProductByManager($param, $admin_id)
    {   
        return Product::draw($param)->with('english', 'french', 'admin', 'tags')->where('product.created_by', $admin_id)->get();
    }


    public function getByProductManager($admin_id){
        return $this->model->with('english', 'french', 'admin', 'tags')->where('created_by', $admin_id)->orderBy('product_id', 'desc')->get();
    }

    public function deleteById($product_id)
    {
        $product = $this->model->find($product_id);
        $product->url()->delete();
        $product->images()->delete();
        return $product->delete();
    }

    public function removeMediaByName($image_name)
    {
        unlink(public_path() . 'upload/product/' . $image_name);
        return ProductImage::where('image_name', 'like', $image_name)->delete();
    }

    public function getAttributesBySetId($attribute_set_id)
    {
        return AttributeSet::with('attributes', 'attributes.options', 'attributes.options.english', 'attributes.options.french')->where('attribute_set_id', $attribute_set_id)->first();
    }

	public function getAttributesByProductId($product_id)
	{
		return $this->model->with(['attributeValues', 'attributeValues.attribute.translation', 'attributeValues.attribute.options.translation'])->where('product_id', $product_id)->first();
	}

	public function deleteVideoById($product_id)
	{
		return ProductVideo::where('product_id', '=', $product_id)->delete();

	}

	public function getProductVideo($product_id)
	{
		return ProductVideo::where('product_id', $product_id)->get();
	}

	public function getProductById($product_id)
	{
		$base_relationships = [
			'translation',
			'url',
			'video',
			'tags',
			'categories.translation',
			'images',
			'attributeValues',
			'attributeValues.option',
			'attributeValues.option.translation',
			'attributeValues.attribute',
			'attributeValues.attribute.translation',
		];
		return $this->model->with($base_relationships)->where('product_id', $product_id)->whereIsActive(1)->first();
	}

    //Avoir la liste des produit par page
    public function getByCategory($input, $array_brands_id)
    {
        $number_per_page = (array_key_exists('nb', $input)) ? $input['nb'] : \App\Product::DEFAULT_NUMBER_PRODUCT_PAGE;
        $order = (array_key_exists('vp', $input)) ? $input['vp'] :  \App\Product::DEFAULT_ORDER;

        $product_entities = [
            "images",
            "url",
            "brand",
            "brand.parent",
            'attributeValues',
            'attributeValues.attribute',
            'attributeValues.option',
            'attributeValues.option.translation',
        ];
        switch ($order) {
            case 'news':
                return Product::filter($input, $array_brands_id)->with($product_entities)->select('product.*','product_translation.*')->paginate($number_per_page);
                break;
            case 'low_price_to_high':
                return Product::filter($input, $array_brands_id)->with($product_entities)->select('product.*','product_translation.*')->orderBy('best_price','asc')->paginate($number_per_page);
                break;
            case 'high_price_to_low':
                return Product::filter($input, $array_brands_id)->with($product_entities)->select('product.*','product_translation.*')->orderBy('best_price','desc')->paginate($number_per_page);
                break;
            case 'best_rating':
                return Product::filter($input, $array_brands_id)->with($product_entities)->select('product.*','product_translation.*')->orderBy('rating','desc')->paginate($number_per_page);
                break;
            case 'discount':
                return Product::filter($input, $array_brands_id)->with($product_entities)->select('product.*','product_translation.*')->orderByRaw("(((original_price - best_price) * 100) /original_price) DESC")->paginate($number_per_page);
                break;
            case 'brand_a_z':
                return Product::filter($input, $array_brands_id)->with($product_entities)->select('product.*','product_translation.*')->orderBy('order_brand_by','asc')->paginate($number_per_page);
                break;
            case 'brand_z_a':
                return Product::filter($input, $array_brands_id)->with($product_entities)->select('product.*','product_translation.*')->orderBy('order_brand_by','desc')->paginate($number_per_page);
                break;
            default:
                break;
        }  //list product pagination in catalogue
    }

    //utiliser pour avoir les produits des class_parents(class)

      public function getProductByCategory($input, $array_brands_id)
    {
        $product_entities = [
            "images",
            "url",
            "brand",
            "brand.parent",
            'attributeValues',
            'attributeValues.attribute',
            'attributeValues.option',
            'attributeValues.option.translation',
        ];
        return Product::filter($input, $array_brands_id)->with($product_entities)->select('product.*','product_translation.*')->get();
       

    }

    public function getByCategories($categories)
	{
		$products = Product::join('product_category', function ($query) {
			$query->on('product_category.product_id', '=', 'product.product_id');
		})->with(["images",
			"url",
			"brand",
			"brand.parent",
		])
			->whereIn('product_category.category_id',$categories)
			->groupBy('product.product_id')
			->inRandomOrder()
			->take(15)
			->get();
		return $products;
	}

	public function getByKeyword($keyword, $language_id)
    {
        return ProductTranslation::with(['products', 'products.url', 'products.images'])->where('product_name', 'like', '%' . trim($keyword) . '%')->where('language_id', $language_id)->paginate(48);
    }

    public function getAttributeByProducts($product_ids){
            $attribute_options = ProductAttributeValue::distinct()
                ->with(['option','attribute','option.translation'])
                ->whereIn('product_id', $product_ids)
                ->get();
        return $attribute_options;
    }

    public function getProductByName($name)
    {
        return ProductTranslation::where('product_name', trim($name))->get()->first();
    }
    public function getByName($product_name,$language_id)
    {
        return ProductTranslation::where('product_name',trim($product_name))->orwhere('product_name', 'like', "% $product_name %")->orwhere('product_name', 'like', "$product_name %")->orwhere('product_name', 'like', "% $product_name")->where('language_id', $language_id)->get()->first();
    }

    public function getByBrandsId($brands_id)
    {
		$brands_id = !is_array($brands_id) ? [$brands_id] : $brands_id;
        $merchants = \DB::table('store')
            ->join('store_brands', 'store.store_id', '=', 'store_brands.store_id')
            ->join('store_users', 'store_users.store_id', '=', 'store.store_id')
            ->join('users', 'users.user_id', '=', 'store_users.user_id')
            ->whereIn('store_brands.brand_id', $brands_id)
            ->groupBy('users.user_id')
            ->select('users.*', 'store.latitude', 'store.longitude')
            ->get();
        return $merchants;
    }

    public function getCount()
	{
		return $this->model->count();
	}

	public function getDashboardProduct()
	{
		return $this->model->with('english','images')->orderBy('product_id','desc')->limit(3)->get();
	}
    
	public function updateBestPrice($product_id)
	{
		$affiliate_product = AffiliateProduct::where('product_id',$product_id)->min('price');
		$product = $this->model->where('product_id',$product_id)->first();
		if(!empty($affiliate_product) && $product->original_price > $affiliate_product)
		{
			return Product::where('product_id',$product_id)->update(['best_price'=>$affiliate_product]);
		} else {
			return Product::where('product_id',$product_id)->update(['best_price'=>$product->original_price]);
		}
		return;
	}

    public function getDoubles()
    {
        return \DB::select("SELECT sys_url_rewrite.target_id FROM sys_url_rewrite INNER JOIN (SELECT target_url FROM sys_url_rewrite GROUP BY target_url HAVING COUNT(target_url) > 1) sys ON sys.target_url = sys_url_rewrite.target_url WHERE sys_url_rewrite.type=2 ORDER BY sys_url_rewrite.target_url;");
    }

    public function getDoublesByManager($user_id)
    {
        return \DB::select("SELECT product.product_id FROM product INNER JOIN product_translation ON product_translation.product_id = product.product_id INNER JOIN (SELECT product_name FROM product_translation WHERE language_id=1 GROUP BY product_name HAVING COUNT(product_name) > 1) name_product ON name_product.product_name = product_translation.product_name WHERE product.created_by=".$user_id." ORDER BY product_translation.product_name");
    }

    public function getProductsByArrayId($array_product_ids)
    {
        return Product::whereIn('product.product_id', $array_product_ids)->get();
    }
}
