<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\Ability;
use App\Models\Product;
use App\Models\Option;
use App\Models\OptionGroup;
use App\Models\ProductCategory;
use App\Models\ProductOption;
use App\Models\Order;
class AdminController extends Controller
{
    public function __construct(){
        // $this->middleware('admin');
    }
    public function abilities(){
        $abilities = Ability::all();
        $data = [
            'success' => true,
            'data' => [
                'count' => $abilities->count(),
                'abilities' => $abilities
            ]
        ];
        return \response()->json($data, 200);
    }
    public function products(){
        $products = Product::withTrashed()->get();
        foreach ($products as $key => $product) {
            $product['category'] = ProductCategory::find($product->product_category_id);
            $product['options'] = $product->options;
        }
        $options = Option::all();
        foreach ($options as $key => $option) {
            $option['group'] = OptionGroup::find($option->option_group_id);
        }
        $data = [
            'success' => true,
            'data' =>  [
                'count' => $products->count(),
                'categories' => ProductCategory::all(),
                'options' => $options,
                'optionGroups' => OptionGroup::all(),
                'products' => $products
            ]
        ];
        return \response()->json($data, 200);
    }
  
    public function product($id){
        $product = Product::withTrashed()->where('id', $id)->get();
        $product['options'] = $product->options;
        foreach ($product['options'] as $key => $option) {
            $option->name = $option->option->name;
        }
        $data = [
            'success' => true, 
            'data' => [
                'product' => $product
            ]
        ];
        return \response()->json($data, 200);
    }
    public function orders()
    {
        $orders = Order::withTrashed()->get();
        foreach ($orders as $key => $order) {
            $order['details'] = $order->details;
        }
        $data = [
            'success' => true, 
            'data' => [
                'count' => $orders->count(),
                'orders' => $orders
            ]
        ];
        return \response()->json($data, 200);
    }
    public function addCategory(Request $request){
        $category = ProductCategory::create([
            'name' => $request->get('name'),
            'icon' => $request->get('icon')
        ]);
        $data = [
            'success' => true, 
            'data' => [
                'message' => 'category added'
            ]
        ];
        return \response()->json($data, 200);
    }
    public function UpdateCategory(Request $request, $id){
        $category = ProductCategory::find($id);
        if (!$category) {
            $data = [
                'success' => false, 
                'data' => [
                    'message' => 'category not found'
                ]
            ];
            return \response()->json($data, 404);
        }
        $category->update([
            'name' => $request->get('name'),
            'icon' => $request->get('icon')
        ]);
        $data = [
            'success' => true, 
            'data' => [
                'message' => 'category updated'
            ]
        ];
        return \response()->json($data, 200);
    }
    public function removeCategory($id){
        $category = ProductCategory::find($id);
        if (!$category) {
            $data = [
                'success' => false, 
                'data' => [
                    'message' => 'category not found'
                ]
            ];
            return \response()->json($data, 404);
        }
        $category->delete();
        $data = [
            'success' => true, 
            'data' => [
                'message' => 'category deleted'
            ]
        ];
        return \response()->json($data, 200);
    }
    public function addOption(Request $request){
        $option = Option::create([
            'name' => $request->get('name'),
            'option_group_id' => $request->get('group')
        ]);
        $data = [
            'success' => true, 
            'data' => [
                'message' => 'option added'
            ]
        ];
        return \response()->json($data, 200);
    }
    public function removeOption($id){
        $option = Option::find($id);
        if (!$option) {
            $data = [
                'success' => true, 
                'data' => [
                    'message' => 'option not found'
                ]
            ];
            return \response()->json($data, 404);
        }
        $option->delete();
        $data = [
            'success' => true, 
            'data' => [
                'message' => 'option deleted'
            ]
        ];
        return \response()->json($data, 200);
    }
    public function addOptionGroup(Request $request){
        $option = OptionGroup::create([
            'name' => $request->get('name'),
        ]);
        $data = [
            'success' => true, 
            'data' => [
                'message' => 'option group added'
            ]
        ];
        return \response()->json($data, 200);
    }
    public function removeOptionGroup($id){
        $group = OptionGroup::find($id);
        if (!$group) {
            $data = [
                'success' => true, 
                'data' => [
                    'message' => 'option group not found'
                ]
            ];
            return \response()->json($data, 404);
        }
        if (Option::where('option_group_id', $group->id)->first()){
            $data = [
                'success' => true, 
                'data' => [
                    'message' => 'can not delete group if not empty'
                ]
            ];
            return \response()->json($data, 404);
        }
        $group->delete();
        $data = [
            'success' => true, 
            'data' => [
                'message' => 'option group deleted'
            ]
        ];
        return \response()->json($data, 200);
    }
}
