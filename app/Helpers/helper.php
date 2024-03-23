<?php 
use App\Models\Category;
function get_categories() {
    return Category::orderBy('name','DESC')
    ->with('sub_category')
    ->where('status',1)
    ->where('showHome','Yes')->get();
}
?>