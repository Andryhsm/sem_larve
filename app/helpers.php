<?php
/**
 * Global helpers file with misc functions
 **/
if (!function_exists('app_name')) {
    /**
     * Helper to grab the application name
     *
     * @return mixed
     */
    function app_name()
    {
        return config('app.name');
    }

}

if (!function_exists('set_active')) {

    /**
     * @param        $path
     * @param string $active
     * @return string
     */
    function set_active($path, $active = 'active')
    {
        return call_user_func_array('Request::is', (array)$path) ? $active : '';
    }
}

if (!function_exists('formatDate')) {

    /**
     * @param $date
     * @return string
     */
    function formatDate($date)
    {
        return Carbon\Carbon::parse($date)->format('m/d/Y');
    }

    /**
     * @param $amount
     * @return string
     */
    function format_price($amount)
    {
        if ($amount == 0) {
            return '$0.00';
        } else {
            return '$' . number_format((float)$amount, 2);
        }
    }

    function format_price_dollar_after($amount)
    {
        if ($amount == 0) {
            return '0.00$';
        } else {
            return number_format((float)$amount, 2).' $';
        }
    }

    /**
     * @param $amount
     * @param $percentage
     * @return string
     */
    function calculateDiscount($amount,$percentage)
    {
        if ($amount == 0) {
            return 'Free';
        } else {
            return  number_format($amount - (($amount * $percentage) / 100),2);
        }
    }

    /**
     * @param $amount
     * @param $percentage
     * @return string
     */
    function calculateDiscountAmount($amount,$percentage)
    {
        if ($amount == 0) {
            return 'Free';
        } else {
            return  number_format((($amount * $percentage) / 100),2);
        }
    }

    /**
     * @param $length
     * @return string
     */
    function random($length)
    {
        $original_string = implode("", array_merge(range(0, 9), range('A', 'Z')));
        return substr(str_shuffle($original_string), 0, $length);
    }
}

if (!function_exists('pre')) {

    /**
     * @param $data
     */
    function pre($data)
    {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }
}

if (!function_exists('postDateFormat')) {

    /**
     * @param $date
     * @return string
     */
    function postDateFormat($date)
    {
        return \Carbon\Carbon::createFromFormat('m-d-Y', $date)->format('Y-m-d');
    }
}

if (!function_exists('formatBirthDate')) {

    /**
     * @param $date
     * @return string
     */
    function formatBirthDate($date)
    {
        return \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format('m-d-Y');
    }
}
if (!function_exists('setBooleanArrayList')) {

    /**
     * @return array
     */
    function setBooleanArrayList()
    {
        return ['1' => 'Yes', '0' => 'No'];
    }
}
if (!function_exists('conditionList')) {

    /**
     * @return array
     */
    function conditionList()
    {
        return ['' => 'Select', '1' => 'Only discount Custom Words', '0' => 'Only discount these Favorite Words'];
    }
}
if (!function_exists('applyOnList')) {

    /**
     * @return array
     */
    function applyOnList()
    {
        return ['' => 'Select', '1' => 'Fixed Amount', '0' => 'Percentage'];
    }
}
if (!function_exists('alphabetLetterArray')) {

    /**
     * @return array
     */
    function alphabetLetterArray()
    {
        return ['A' => 'A', 'B' => 'C', '0' => 'Percentage'];
    }
}
if (!function_exists('changeColorArray')) {

    /**
     * @return array
     */
    function changeColorArray()
    {
        return [''=>'All','1' => 'Color', '2' => 'GrayScale'];
    }
}



if (!function_exists('getImages')) {

    /**
     * @return array
     */
    function getImages($image_ids)
    {
        return \App\Models\Image::whereIn('image_id',$image_ids)->get();
    }
}

if (!function_exists('checkWeekends')) {


    /**
     * @param $date
     * @return mixed
     */
    function checkWeekends($date)
    {
        $now = \Carbon\Carbon::now();
        while($now <= $date)
        {
            if($now->dayOfWeek === \Carbon\Carbon::SATURDAY){
                $now->addDays(2);
                $date->addDays(2);
            }elseif($now->dayOfWeek === \Carbon\Carbon::SUNDAY){
                $now->addDays(1);
                $date->addDays(1);
            }
            $now->addDay();
        }
        return $date;
    }
}

if (!function_exists('convertDateTime')) {


    /**
     * @param $date
     * @return string
     */
    function convertDateTime($date)
    {
       return  \Carbon\Carbon::parse($date)->format('m/d/Y h:i A');
    }
}

if(!function_exists('imageWatermark')){

    function imageWatermark($image){
        // Remove the extension from the filename
        $ext = pathinfo($image, PATHINFO_EXTENSION);
        $image = basename($image,".".$ext);

        // Create the common name for the watermarked image
        $watermarked_image_name = 'images/watermark/watermark-'.$image.'.png';

        // Check if we have already created the watermarked images
        $exist =  file_exists(public_path($watermarked_image_name));
        if($exist){
            return asset($watermarked_image_name);
        }else{
            $watermark = Image::make(asset('images/copyright.png'))->resize(600,900);
            $image= Image::make('images/upload/product/'.$image.".".$ext)->insert($watermark,'center')->save($watermarked_image_name);
            chmod(($image->dirname.'/'.$image->basename),0644);
            return asset($image->dirname.'/'.$image->basename);
        }
    }
}

if (!function_exists('thumbImageWatermark')) {
    function thumbImageWatermark($image)
    {
        // Remove the extension from the filename
        $ext   = pathinfo($image, PATHINFO_EXTENSION);
        $image = basename($image, "." . $ext);

        // Create the common name for the watermarked image
        $thumbnail_image_name = 'images/watermark/thumb/' . $image . '.png';
        // Check if we have already created the watermarked images
        $exist = file_exists(public_path($thumbnail_image_name));
        if ($exist) {
            return asset($thumbnail_image_name);
        } else {
            $image = Image::make('images/watermark/' . $image . '.png')->resize(125, 188)->save($thumbnail_image_name);
            chmod(($image->dirname . '/' . $image->basename), 0644);

            return asset($image->dirname . '/' . $image->basename);
        }
    }
}


if (!function_exists('thumbProductImage')) {
    function thumbProductImage($image_name)
    {
        // Remove the extension from the filename
        $ext   = pathinfo($image_name, PATHINFO_EXTENSION);
        $image = basename($image_name, "." . $ext);

        // Create the common name for the thumb image
        $thumbnail_image_name = 'images/upload/product/thumb/' . $image_name;
        // Check if we have already created the thumbnail images
        $exist = file_exists(public_path($thumbnail_image_name));
        if ($exist) {
            return asset($thumbnail_image_name);
        } else {
            $image = Image::make(public_path('images/upload/product/'. $image_name))->resize(125, 188)->save($thumbnail_image_name);
            chmod(($image->dirname . '/' . $image->basename), 0644);

            return asset($image->dirname . '/' . $image->basename);
        }
    }
}


if (!function_exists('getLength')) {


    /**
     * @param $string
     * @return int
     */
    function getLength($string)
    {
        return  strlen(str_replace(' ', '', $string));
    }
}
if (!function_exists('getDeliveryDate')) {

    function getDeliveryDate($estimated_date)
    {
        return $estimated_date->min_delivery_time . " - " . $estimated_date->max_delivery_time;
    }
}

if (!function_exists('encryptString')) {

    function encryptString($string)
    {
        return Crypt::encrypt($string);
    }
}
if (!function_exists('decryptString')) {
    /**
     * @param $string
     * @return string
     */
    function decryptString($string)
    {
        return Crypt::decrypt($string);
    }
}


/**
 * @param $id
 * @param $array
 * @return null
 */
if (!function_exists('searchForLetter')) {
    function searchForLetter($id, $array)
    {
        $final = "";
        foreach ($array as $key => $val) {
            if ($val->alphabet_letter === $id) {
                $final[] = $val;
            }
        }
        return $final;
    }
}

if (!function_exists('changeFileExtension')) {
    function changeFileExtension($filename)
    {
        return str_replace(array(".jpg",".JPG"),array(".png",".png"),$filename);
    }
}

if (!function_exists('copyrightImage')) {
    function copyrightImage($start_year)
    {
        $string = "&copy; Copyright ";
        $string .= date('Y');
        $string .= " <a href=\"http://www.whatsthewordshop.com\" target=\"_blank\" style=\"color:#fff; text-decoration:none;\">What's the Word?</a>";
        return stripslashes($string);
    }
}

if(!function_exists('prepareLetterArray'))
{
    function prepareLetterArray()
    {
        $letter_arr = [];
        $letter_arr[''] = " - Select Alphabet Letter -";
        foreach (range('A', 'Z') as $v) {
            $letter_arr [$v] = $v;
        }
        return $letter_arr;
    }

}


if(!function_exists("getImageNameWithoutExtension"))
{
    function getImageNameWithoutExtension($image){
        $ext = pathinfo($image, PATHINFO_EXTENSION);
        return basename($image,".".$ext);
    }
}

if(!function_exists("get_training_pages"))
{
    function get_training_pages() {
        return \App\Models\Page::with('url')->with('english')->where('status',1)->get();
    }
}

if (!function_exists('convertDate')) {


    /**
     * @param $date
     * @return string
     */
    function convertDate($date)
    {
        return  \Carbon\Carbon::parse($date)->format('F j, Y');
    }
}

function getPrice($price,$symbol='$'){
    return $symbol.$price;
}

function checkRouteExists($route, $route_name)
{
    if (in_array($route_name, $route)) {
        return true;
    }
    return false;
}


if (!function_exists('check_route_exists')) {

    /**
     * @param        $path
     * @param string $active
     * @return string
     */
    function check_user_access($route)
    {
        if(!is_array($route))
            $route = array($route);
        foreach($route as $path){
            if (in_array($path, app('user_permission'))) {
                return true;
            }
        }
        return false;
    }
}

function getRebate($best_price, $original_price)
{
	$rebate = $original_price - $best_price;
	return number_format(($rebate*100)/$original_price,2).'%';
}

function videoType($url)
{
    return (strpos($url, 'youtube') > 0) ? 'youtube' : 'unknown';
}


function parse_youtube($link)
{
    $regexstr = '~
            # Match Youtube link and embed code
            (?:                             # Group to match embed codes
                (?:<iframe [^>]*src=")?       # If iframe match up to first quote of src
                |(?:                        # Group to match if older embed
                    (?:<object .*>)?      # Match opening Object tag
                    (?:<param .*</param>)*  # Match all param tags
                    (?:<embed [^>]*src=")?  # Match embed tag to the first quote of src
                )?                          # End older embed code group
            )?                              # End embed code groups
            (?:                             # Group youtube url
                https?:\/\/                 # Either http or https
                (?:[\w]+\.)*                # Optional subdomains
                (?:                         # Group host alternatives.
                youtu\.be/                  # Either youtu.be,
                | youtube\.com              # or youtube.com
                | youtube-nocookie\.com     # or youtube-nocookie.com
                )                           # End Host Group
                (?: /watch\?v= | \S*[^\w\-\s])?           # Extra stuff up to VIDEO_ID
                ([\w\-]{11})                # $1: VIDEO_ID is numeric
                [^\s]*                      # Not a space
            )                               # End group
            "?                              # Match end quote if part of src
            (?:[^>]*>)?                       # Match any extra stuff up to close brace
            (?:                             # Group to match last embed code
                </iframe>                 # Match the end of the iframe
                |</embed></object>          # or Match the end of the older embed
            )?                              # End Group of last bit of embed code
            ~ix';

    preg_match($regexstr, $link, $matches);
    if (isset($matches[1]))
        return $matches[1];
    return 0;
}

function getPercentage($original_price,$best_price)
{
	return "-".number_format((($original_price - $best_price)*100)/$original_price,0).'%';
}

function getRadiusData()
{
	return ['5'=>'5 KM','10'=>'10 KM','15'=>'15 KM','20'=>'20 KM','35'=>'35 KM','50'=>'50 KM','100'=>'100 KM'];
}

function getCommission($amount)
{
	return number_format((($amount*\App\Models\Invoice::COMMISSION_PERCENTAGE)/100),2);
}

function getAvailableHours()
{
	return ['24h'=>'24h','48h'=>'48h','72h'=>'72h','4 days'=>'4 days','5 days'=>'5 days','6 days'=>'6 days','7 days'=>'7 days'];
}




//Supprimer la valeur d'un tableau numerique en gardant l'ordonance de son indexe
function array_middle_shift(&$array,$key) {
    $length=(($key+1)-count($array)==0)?1:($key+1)-count($array);
    return array_splice($array,$key,$length);
}

function get_language_id(){
    return app('language')->language_id;
}

function add_area_in_cookie($zip, $distance){
    $num_of_minutes = 60 * 24 * 7 * 4 * 6; // one week
    Cookie::queue(Cookie::make('zip_code', $zip, $num_of_minutes));
    Cookie::queue(Cookie::make('distance', $distance, $num_of_minutes));
}



function explode_multi($delemiter, $array_string){
    $result_string = [];
    foreach ($array_string as $array) {
        $result_string = array_merge($result_string, explode(',', $array));
    }
    return $result_string;
}


function stripe_account_name(){
    return \App\StripeAccount::where('is_active', 1)->first()->stripe_account_name;
}

function stripe_account_publishable_key(){
    $stripe_account = App\StripeAccount::where('is_active', 1)->first();
    if($stripe_account)
        return $stripe_account->publishable_key;
    else
        return null;
}

function stripe_account_secret_key(){
    $query = \App\StripeAccount::where('is_active', 1)->first()->secret_key;
    if($query)
        return $query;
    else
        return null;
}

function average_rating($product_id){
    $reviews = \App\Models\ProductRating::where('product_id',$product_id)->where('status', 1)->orderBy('review_date','desc')->paginate(4);
    $total_ratings = \App\Models\ProductRating::where('product_id',$product_id)->where('status', 1)->sum('rating');
    $average_rating = count($reviews) > 0 ? round($total_ratings/count($reviews)): 0;
    return $average_rating;
}

function count_reviews($product_id){
    $reviews = \App\Models\ProductRating::where('product_id',$product_id)->where('status', 1)->orderBy('review_date','desc')->paginate(4);
    return count($reviews);
}

function count_tickets(){
    $status = \App\Models\Statuses::where('is_default',1)->first();
    if ($status) {
        $tickets = \App\Models\Ticketit::where('status_id',$status->id)->get();
        return count($tickets);
    }
    
}

function get_pre_keyword() {
    //auth()->guard('admin')->user();
    return 'admin';
}