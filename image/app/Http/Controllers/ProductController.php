<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Product;
use App\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::select()->get();

        return view('admin.product.list',['products'=>$products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rule= [
            "name" => "required",
            "price" => "required",
        ];
        $request->validate($rule);
        $data_request = $request->all();
        $data_product = [
           "name" => $data_request['name'],
           "price" => $data_request['price'],
        ];
        $data_images = $data_request['file']['image'];

        
         // dd($data_images);
        if ($product = Product::create($data_product)) {
            foreach ($data_images as $key => $value) {
            $data_images = [
               "src" => $value,
            ];
            $product->images()->create($data_images);
        }
        }
        // return redirect()->route('admin.product_index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('admin.product.form',[ 'product' => $product ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $data_images = $request['file']['image'];
        $rule= [
            "name" => "required",
        ];
        $request->validate($rule);
        $product = Product::find($id);
        if ($product->update($request->all())) {
            foreach ($data_images as $key => $value) {
                $id_img = $value['id'];
                $src_img_new = $value['src'];
                $img_old = Image::find($id_img);
                $src_img_old = $img_old->src;
                if ($img_old->update(['src' => $src_img_new ])) {
                    File::delete($src_img_old);
                };
            }
        }
        return redirect()->route('admin.product_index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('admin.product_index');
    }
    public function uploadimage(Request $request)
    {
        // dd('upload_image');
        $danhsach_images= [];
        foreach ($request->file as $key => $file) {
            $name = md5(uniqid(rand(), true)).'_'.time().'.'.$file->getClientOriginalExtension(); 
            $destinationPath = public_path('uploads'); 
            $file->move($destinationPath, $name);
            $nameReturn = 'uploads/'.$name; 
            array_push($danhsach_images, $nameReturn); 
        }
        return $danhsach_images;
    }

    public function edit_image(Request $request)
    {
        $danhsach_images= [];
        foreach ($request->file as $key => $file) {
            $name = md5(uniqid(rand(), true)).'_'.time().'.'.$file->getClientOriginalExtension(); 
            $destinationPath = public_path('uploads'); 
            $file->move($destinationPath, $name);
            $nameReturn = 'uploads/'.$name;  
            array_push($danhsach_images, $nameReturn); 
        }
        return $danhsach_images;
    }

    public function delete_image($id)
    {
        dd('delete_image');
    }
}
