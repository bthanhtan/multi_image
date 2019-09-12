@extends('admin.master')

@section('title', 'Page Title')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@section('content')
        
        <form class="user" enctype="multipart/form-data" action="{{ isset($product->id) ?  route('admin.product_update',['id'=>$product->id]) : route('admin.product_store')}}" method="post">
            @if(isset($product->id))
            @method('put')
            @endif
            @csrf
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

                        <img class="{{$class_img_tag}}" src="http://weblocal.win/{{$value->src}}" width="200">

                        <input type="text" name="file[image][{{$key}}][id]" value="{{$value->id}}"/>

                        <input class="{{$class_input_tag}}" type="text" name="file[image][{{$key}}][src]" value="{{$value->src}}"/>

                        <input  id="file" type="file" name="" value="Edit" onchange="edit_Image_change(this, {{$value->id}})"/>

                        <input type="button" class="btn btn-danger" value="Delete" onclick="delete_Image({{$value->id}})"> <br><br>
            <?php  }           
            } 

            else{ ?>
                <label for="file">Chọn thêm file</label>
                <input  id="file" type="file" name="image" required="" multiple onchange="upload_Image_change(this)"/>
                <div id="them_img"></div>
                <p class="name_img"></p>
            
            <?php
            }
            ?>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

@stop

@section('javascript')
<script src="{{ url('admin/product.js') }}"></script>
@stop
