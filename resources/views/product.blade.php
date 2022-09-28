<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Products View</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>

<select name="category" id="category">
    <option value="">Select Category</option>
    @if (count($categories)>0)
        @foreach($categories as $category)
        <option value="{{$category['id']}}">{{$category->name}}</option>
        @endforeach
    @endif
</select>
<br><br>
<table border = "1"  >
<tr>
<td>Id</td>
<td>Name</td>
<td>Price</td>
<td>Description</td>
</tr>
@foreach($products as $product)
<tr class="tbody">
<td>{{$product->id }}</td>
<td>{{$product->name }}</td>
<td>{{$product->price}}</td>
<td>{{$product->description}}</td>
</tr>
@endforeach
</table>


<script>
    $(document).ready(function(){
        $("#category").on('change', function(){
            var category =$(this).val();
            $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $.ajax({
                url:"{{route('/filters')}}",
                type:"GET",
                data:{'category':category},
                success:function(data){
                 var products = data.products;
                 var html = " ";
                 if(products.length > 0){
                 for(let i = 0; i<products.length; i++){
                    html += '<tr>\
                        <td>'+i+'</td>\
                        <td>'+products[i]['name']+'</td>\
                        <td>'+products[i]['price']+'</td>\
                        <td>'+products[i]['description']+'</td>\
                            </tr>';
                 }
                }
                else {
                    html += '<tr>\
                            <td>No Products Found.</td>\
                            </tr>';
                }
             $("#tbody").html(html);
            }
            });
        });
    });
</script>
</body>
</html>
