@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 card p-3">
            <h4 class="text-dark">Votre panier</h4>
            <table>
            	<thead>
            		<tr>
            			<th>Image</th>
            			<th>Titre</th>
            			<th>Quantité</th>
            			<th>Prix</th>
            			<th>Total</th>
            			<th></th>
            		</tr>
            	</thead>
            	<tbody>
            		@foreach($items as $item)
                       <tr>
                       	<td>
                       		<img src="{{asset($item->associatedModel->image)}}" alt="{{$item->title}}" width="50" height="50" class="img-fluid rounded">
                       	</td>
                       	<td>
                       		{{$item->name}}
                       	</td>
                       	<td>
                       	  <form action="{{route('update.cart',$item->associatedModel->slug)}}" method="post" class="d-flex flex-row justify-content-center align-items-center">
                            @csrf
                            @method("PUT")
                            <div class="form-group">
                              <input type="number" name="qty" id="qty" value="{{$item->quantity}}" placeholder="Quantité" max="{{$item->associatedModel->inStock}}" min="1" class="form-control">
                            </div>
                            <div class="form-group">
                              <button type="submit" class="btn btn-sm btn-warning">
                                <i class="fa fa-edit"></i>
                              </button>
                            </div>
                          </form>
                       	</td>
                       	<td>
                       		{{$item->price}} TND
                       	</td>
                       	<td>
                       		{{$item->price * $item->quantity}} TND
                       	</td>
                       	<td>
                       	  <form action="{{route('remove.cart',$item->associatedModel->slug)}}" method="post" class="d-flex flex-row justify-content-center align-items-center">
                            @csrf
                            @method("DELETE")
                            <div class="form-group">
                              <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fa fa-trash"></i>
                              </button>
                            </div>
                          </form>
                       	</td>
                       </tr>
            		@endforeach
            		<tr class="text-dark font-weight-bold">
            			<td colspan="3" class="border border-success">
            				Total
            			</td>
            			<td colspan="3" class="border border-success">
            				{{Cart::getSubTotal()}} TND
            			</td>
            		</tr>
            	</tbody>
            </table>
            @if(Cart::getSubTotal() > 0)
             <div class="form-group">
               <a href="{{route('make.payment')}}" class="btn btn-primary mt-3">
                 Payer {{Cart::getSubTotal()}} TND via PayPal
               </a>
             </div>
            @endif
        </div>
    </div>
</div>
@endsection