@extends('admin.app')
@section('content')

<div class="table-agile-info">
  
  <div class="panel panel-default">
    <div class="panel-heading">
     <h4 style="color:red">User Detail</h4> 
    </div>
    
    <div class="table-responsive">
                      <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
           
            <th>Custommer Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
        
          <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->phone}}</td>
            <td>{{$user->email}}</td>
          </tr>
     
        </tbody>
      </table>

    </div>
   
  </div>
</div>
<br>
<div class="table-agile-info">
  
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 style="color:red">Shipping Detail</h4> 
    </div>
    <div class="table-responsive">
                      <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
           
            <th>Shipping Name</th>
            <th>Shipping Address</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Note</th>
            <th>Shipping Method</th>
            <th>Payment Method</th>
          
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
        
          <tr>
           
             <td>{{$shippings->shipping_name}}</td>
            <td>{{$shippings->shipping_address}}</td>
             <td>{{$shippings->shipping_phone}}</td>
             <td>{{$shippings->shipping_email}}</td>
             <td>{{$shippings->shipping_notes}}</td>
             <td>{{$shippings->shipping_method}}</td>
             <td>{{$orders->payment_content}}</td>
    
          </tr>
     
        </tbody>
      </table>

    </div>
   
  </div>
</div>
<br><br>

<div class="table-agile-info">
  
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 style="color:red">Order Detail</h4> 
    </div>
   
    <div class="table-responsive">
                      <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
    
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Product Name</th>
            <th>Quantity in Stock</th>
            <th>Shipping Fee</th>
            <th>Order Quantity</th>
            <th>Price</th>
            <th>Coupon/Voucher</th>
            <th>Total</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @php 
          $i = 0;
          $total = 0;
          @endphp
        @foreach($orders ->orderdetail as $details)

          @php 
          $i++;
          $subtotal = $details->product_price*$details->product_quantity;
          $total+=$subtotal;
          @endphp
          <tr class="color_qty_{{$details->product_id}}">
           
            <td><i>{{$i}}</i></td>
            <td>{{$details->product_name}}</td>
            <td>{{$details->product->quantity}}</td>
   
            <td>
               @if($shippings->shipping_method == 'Free_Ship' )
               ${{number_format(0 ,2,',','.')}}</td>
               @else
               ${{number_format($details->product_feeship ,2,',','.')}}</td>
               @endif
            <td>
              {{$details->product_quantity}}
              <input hidden type="number" min="1" {{$orders->order_status==2 ? 'disabled' : ''}} class="order_qty_{{$details->product_id}}" value="{{$details->product_quantity}}" name="product_sales_quantity">

              <input type="hidden" name="order_qty_storage" class="order_qty_storage_{{$details->product_id}}" value="{{$details->product->quantity}}">
                  
              <input type="hidden" name="order_id" class="order_id" value="{{$details->order_id}}">

              <input type="hidden" name="order_product_id" class="order_product_id" value="{{$details->product_id}}">

       

            </td>
            <td>${{number_format($details->product_price ,2,',','.')}}</td>
                
            <td>@if($orders->usedvoucher!=null)
              {{$orders->usedvoucher}}
            @else 
              No Coupon Code
            @endif
        </td>
            <td>${{number_format($subtotal ,2,',','.')}}</td>

          </tr>
        @endforeach
          <tr>
            <td colspan="2">  
            @php 
                $total_coupon = 0;
              @endphp
              @if($voucher && $voucher->discounttype == 2)
                  @php
                  $discount = $voucher->discount;
                  $total_after_coupon = ($total* $discount)/100;
                  echo 'Total Discount : $'.number_format($total_after_coupon,2,',','.').'</br>';
                  $total_coupon = $total + $details->product_feeship - $total_after_coupon ;
                  @endphp
              @elseif($voucher && $voucher->discounttype == 1)
                  @php
                       $discount = $voucher->discount;
                  echo 'Total Discount : $'.number_format( $discount,2,',','.').''.'</br>';
                  $total_coupon = $total + $details->product_feeship -  $discount ;
                  @endphp
              @elseif(!$voucher)
              @php
              echo 'Total Discount : $'.number_format( 0,2,',','.').''.'</br>';
              $total_coupon = $total + $details->product_feeship ;
              @endphp
              @endif

              Shipping Fee : ${{number_format($details->product_feeship,2,',','.')}}</br> 
              Pay: ${{number_format($total_coupon,2,',','.')}}
            </td>
          </tr>
          <tr>
            <td colspan="6">
    
                @if($orders->order_status==1)
                <form>
                   @csrf
                  <select class="form-control order_details">
                    <option id="{{$orders->order_id}}" selected value="1">Paid  Order processing </option>
                    <option id="{{$orders->order_id}}" value="2">Order processed</option>
                  </select>
                </form>
                @elseif($orders->order_status==2)
                <form>
                  @csrf
                  <select class="form-control order_details">
           
                    <option id="{{$orders->order_id}}" selected value="2">Order processed</option>
                    <option id="{{$orders->order_id}}" value="3"> Delivery</option>
                  </select>
                </form>

                @elseif($orders->order_status==3)
                <form>
                  @csrf
                  <select class="form-control order_details">
                    <option id="{{$orders->order_id}}" selected value="3">Delivery</option>
                    <option id="{{$orders->order_id}}" value="4">  Delivered-Completed</option>
                    <option id="{{$orders->order_id}}" value="8"> Customer Do Not Receive /Refuse Order</option>
                  </select>
                </form>

                @elseif($orders->order_status==4)
                <form>
                  @csrf
                  <select class="form-control order_details">
                    <option id="{{$orders->order_id}}" selected value="4">Delivered-Completed</option>
                  </select>
                </form>
                @elseif($orders->order_status==5)
                <form>
                  @csrf
                  <select class="form-control order_details">
                    <option id="{{$orders->order_id}}"  selected value="5"> Order Canceled</option>
           
                  </select>
                </form>

                @elseif($orders->order_status==7)
                <form>
                   @csrf
                  <select class="form-control order_details">
                    <option id="{{$orders->order_id}}"  value="2">Order processed</option>
                    <option id="{{$orders->order_id}}" selected value="7">COD Order processing</option>
                  </select>
                </form>

                @else
                <form>
                   @csrf
                  <select  class="form-control order_details">
                    <option id="{{$orders->order_id}}"  value="2">Order processed</option>
                    <option id="{{$orders->order_id}}" selected value="8">Customer Do Not Receive /Refuse Order</option>
                  </select>
                </form>
                @endif
            </td>
          </tr>
        </tbody>
      </table>
      <a target="_blank" href="{{url('/print-order/'.$details->order_id)}}">Print Order</a>
    </div>
   
  </div>
</div>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script type="text/javascript">
  $('.order_details').change(function(){
    
      var order_status = $(this).val();
      var order_id = $(this).children(":selected").attr("id");
      var _token = $('input[name="_token"]').val();
      //lay ra so luong
      quantity = [];
      $("input[name='product_sales_quantity']").each(function(){
          quantity.push($(this).val());
      });

      storequantity = [];
      $("input[name='order_qty_storage']").each(function(){
        storequantity.push($(this).val());
      });

      //lay ra product id
      order_product_id = [];
      $("input[name='order_product_id']").each(function(){
          order_product_id.push($(this).val());
      });

      j = 0;
      for(i=0;i<order_product_id.length;i++){
          //so luong khach dat
          var order_qty = $('.order_qty_' + order_product_id[i]).val();
          //so luong ton kho
          var order_qty_storage = $('.order_qty_storage_' + order_product_id[i]).val();
    
          if(parseInt(order_qty)>parseInt(order_qty_storage) && order_status in[1,7,8]){
              j = j + 1;
              if(j==1){
                  alert('We dont have enough in Store');
              }
              $('.color_qty_'+order_product_id[i]).css('background','#1d8296');
          }
      }
      if(j==0){
        
              $.ajax({
                      url : '{{url('/update-order-qty')}}',
                          method: 'POST',
                          data:{_token:_token, order_status:order_status ,order_id:order_id ,quantity:quantity, order_product_id:order_product_id},
                          success:function(data){
                              alert('Changed Order Status Sucessfully');
                              location.reload();
                          }
              });
          
      }



  });
</script>

@endsection