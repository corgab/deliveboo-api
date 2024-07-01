@extends('layouts.app')

@section('content')
<form action="{{route('admin.dishes.store')}}" method="POST">
    @csrf

    <!-- Restaurant_id value-->
    <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
    
    <div class="mb-4">
        <label for="name_project" class="form-label fw-bold">Name</label>
        <input type="text" name="name" class="form-control" id="name" placeholder="Write your Name Restaurant" value="{{old('name')}}">
    </div>
    <div class="mb-4">
        <label for="description_ingredients" class="form-label fw-bold">Description/Ingredients</label>
        <input type="text" name="description_ingredients" class="form-control" id="description_ingredients" placeholder="Describe your dish" value="{{old('description_ingredients')}}">
    </div>
    <div class="mb-4">
        <label for="price" class="form-label fw-bold">Price</label>
        <textarea type="text" name="price" class="form-control" id="price" placeholder="Insert the price" rows="8" value="{{old('price')}}">
        </textarea>
    </div>
    <div class="input-group mb-3">
        <input type="file" class="form-control" id="thumb" name="thumb" value="{{ old('thumb') }}">
    </div>
    <div class="form-check">
        <label class="form-check-label" for="visible">
            Visible:
        </label>
    </div>
    <select name="visible" id="visible">
        <option value="0">no</option>
        <option value="1">si</option>
    </select>
    <div class="d-flex justify-content-evenly pt-3">
        <button type="submit" class="btn btn-primary fw-bold">Create</button>
        <a href="{{route('admin.dishes.index')}}" class="btn btn-warning text-primary fw-bold">Back</a>
    </div>
</form>


<div class="my-4 centered w-25">
    @if ( $errors->any() )
    <div class="alert alert-danger op-90">
        <ul>
            @foreach($errors->all() as $error)
            <li>
                {{ $error }}
            </li>
            @endforeach
        </ul>
    </div>
    @endif
</div>
@endsection