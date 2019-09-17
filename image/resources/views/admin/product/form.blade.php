@extends('admin.master')

@section('title', 'Page Title')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@section('content')
        
        <form class="user" enctype="multipart/form-data" action="{{ isset($product->id) ?  route('admin.product_update',['id'=>$product->id]) : route('admin.product_store')}}" method="post">
            @if(isset($product->id))
            @method('put')
            @endif
            @csrf
            <?php $dem = 0; ?>
            <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="name" value="{{ old('name', $product->name ?? '') }}">
                <small id="" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Price</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="price" value="{{ old('price', $product->price ?? '') }}">
                <small id="" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <?php 
            if (isset($product->id)) { 
                $local_link = "http://localhost/Laravel/multi_image/image/public/";
               $img_products = $product->images;
                 // dd($img_products);
                 foreach ($img_products as $key => $value) {
                        $class_img_tag = "new_val_img_".$value->id;
                        $class_input_tag = "new_val_input_".$value->id;
                        $a = [
                            "id" => $value->id,
                            "src" => $value->src,
                        ];
                        ?>
                        <div class="parent_{{$value->id}} abcd">
                            <img class="{{$class_img_tag}}" src="{{$local_link}}{{$value->src}}" width="200">

                            <input type="text" name="file[image][{{$key}}][id]" value="{{$value->id}}"/>

                            <input class="{{$class_input_tag}}" type="text" name="file[image][{{$key}}][src]" value="{{$value->src}}"/>

                            <input  id="file" type="file" name="" value="Edit" onchange="edit_Image_change(this, {{$value->id}})"/>

                            <input type="button" class="btn btn-danger btn_delete_{{$value->id}}" value="Delete" onclick="delete_Image(this,{{$value->id}})"> <br><br>
                        </div>
            <?php  
                        $dem = $key;}  
            
            } ?>

            <label for="file">Chọn thêm file</label>
                <input  id="file" type="file" name="image"  multiple onchange="upload_Image_change(this, {{$dem}})"/>
                <div id="them_img"></div>
                <p class="name_img"></p>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

@stop

@section('javascript')
<script src="{{ url('admin/product.js') }}"></script>
@stop
