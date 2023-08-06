@extends('layouts.app')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between">
        <h4><i class="fa fa-list" aria-hidden="true"></i> Listado de post</h4>
    </div>
    <hr class="border border-primary">
        <br>
        <form>
        <div class="row">
            <div class="col-md-12">
                <div class="input-group mb-3">
                    <input type="text" name="search" class="form-control border border-secondary" placeholder="User ID" aria-label="search">
                    <div class="input-group-append">
                    <button class="btn btn-primary text-light"><i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
                    @if($flag)
                        <button href="#" class="btn btn-outline-warning" id="BtnVolver">Volver</button>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </form>
    @if(!empty($data->userData))
    <div class="card">
        <div class="card-header bg-primary text-light"><i class="fa fa-address-card" aria-hidden="true"></i> User data</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="id">Id</label>
                        <input type="text" id="id " value="{{$data->userData["id"]}}"  class="form-control border border-input" disabled>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" value="{{$data->userData["name"]}}"  class="form-control border border-input" disabled>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" value="{{$data->userData["username"]}}"  class="form-control border border-input" disabled>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" id="email" value="{{$data->userData["email"]}}"  class="form-control border border-input" disabled>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <h6>Address</h6>
                <hr class="border border-secondary">
            </div>
            <div class="row"> 
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="street">street</label>
                        <input type="text" id="street" value="{{$data->userData["address"]["street"]}}"class="form-control border border-input" disabled>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="suite">suite</label>
                        <input type="text" id="suite" value="{{$data->userData["address"]["suite"]}}" class="form-control border border-input" disabled>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="city">city</label>
                        <input type="text" id="city"  value="{{$data->userData["address"]["city"]}}" class="form-control border border-input" disabled>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="zip_code">zip code</label>
                        <input type="text" id="zip_code" value="{{$data->userData["address"]["zipcode"]}}" class="form-control border border-input" disabled>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="lat">Lat</label>
                        <input type="text" id="lat" value="{{$data->userData["address"]["geo"]["lat"]}}"  class="form-control border border-input" disabled>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="lon">Lon</label>
                        <input type="text" id="lon" value="{{$data->userData["address"]["geo"]["lng"]}}"  class="form-control border border-input" disabled>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" id="phone" value="{{$data->userData["phone"]}}"  class="form-control border border-input" disabled>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="website">website</label>
                        <input type="text" id="website" value="{{$data->userData["website"]}}"  class="form-control border border-input" disabled>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <h6>Company</h6>
                <hr class="border border-secondary">
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">name</label>
                        <input type="text" id="name" value="{{$data->userData["company"]["name"]}}"  class="form-control border border-input" disabled>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="catchPhrase">catchPhrase</label>
                        <input type="text" id="catchPhrase" value="{{$data->userData["company"]["catchPhrase"]}}"  class="form-control border border-input" disabled>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="bs">bs</label>
                        <input type="text" id="bs" value="{{$data->userData["company"]["bs"]}}"class="form-control border border-input" disabled>
                    </div>
                </div>
            </div>
            </div>
    </div>
    @endif
    <br><br>
    <div class="table-responsive">
        <div class="col-md-12">
            <table class="table table-striped table-hover table-bordered">
                <thead >
                    <tr >
                        <th class="bg-primary text-light" class="text-darl bg-light text-center">Id</th>
                        <th class="bg-primary text-light" class="text-darl bg-light text-center">Title</th>
                        <th class="bg-primary text-light" class="text-darl bg-light text-center">Body</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($data->postData))
                        @foreach($data->postData as $post)
                        <tr>
                            <td>{{$post["id"]}}</td> 
                            <td>{{$post["title"]}}</td> 
                            <td>{{$post["body"]}}</td> 
                        </tr>
                        @endforeach
                    @else 
                    <tr>
                        <td colspan="7">
                            <div class="col-md-12">
                                <div class="alert alert-danger">Para visualizar datos debe consultar un idUser</div>
                            </div>  
                        </td>
                    </tr>              
                    @endif
                </tbody>        
            </table>
        </div>
    </div>
</div>
@endsection