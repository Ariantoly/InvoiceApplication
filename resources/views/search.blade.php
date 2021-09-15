<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Invoice</title>
</head>
<body>
    <div class="searchInvoice">
        <form action="/searchInvoice" method="POST">
        @csrf
            <label for="no">No Invoice</label>
            <input type="text" name="no" id="no">
            <input type="submit" value="View" id="btnView">
        </form>
    </div>

    <br>
    
    <div class="detail">
        <div class="invoiceDetail">
            <span>Invoice Detail</span>
        </div>
        <br>
        <div class="form">
            <form action="/update" method="POST">
            @csrf
                <div class="left">
                    <div hidden>
                        <input type="text" name="no" id="no" value="{{$invoice['InvoiceNo']}}" disabled hidden>
                    </div>
                    <div>
                        <div><label for="date">Invoice Date</label></div>
                        <div><input type="text" name="date" id="date" value="{{$invoice['InvoiceDate']}}"></div>
                    </div>
                    <br>
                    <div>
                        <div><label for="to">To</label></div>
                        <div><textarea name="to" id="to" cols="30" rows="6">{{$invoice['InvoiceTo']}}</textarea></div>
                    </div>
                    <br>
                    <div>
                        <div><label for="salesName">Sales Name</label></div>
                        <div>
                            <select name="sales" id="sales">
                                @foreach($invoice['Data']['Sales'] as $sales){
                                    @if($sales->SalesName == $invoice['SalesName'])
                                        <option value="{{$sales->SalesName}}" selected="selected">{{$sales->SalesName}}</option>
                                    @else
                                    <option value="{{$sales->SalesName}}">{{$sales->SalesName}}</option>
                                    @endif
                                }
                                @endforeach 
                            </select>
                        </div>
                    </div>
                    <br>
                    <div>
                        <div><label for="courier">Courier</label></div>
                        <div>
                            <select name="courier" id="courier">
                                @foreach($invoice['Data']['Courier'] as $courier){
                                    @if($courier->CourierName == $invoice['CourierName'])
                                        <option value="{{$courier->CourierName}}" selected="selected">{{$courier->CourierName}}</option>
                                    @else
                                    <option value="{{$courier->CourierName}}">{{$courier->CourierName}}</option>
                                    @endif
                                }
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="right">
                    <div>
                        <div><label for="shipTo">Ship To</label></div>
                        <div><textarea name="shipTo" id="shipTo" cols="30" rows="6">{{$invoice['ShipTo']}}</textarea></div>
                    </div>
                    <br>
                    <div>
                        <div><label for="payment">Payment Type</label></div>
                        <div>
                            <select name="payment" id="payment">
                                @foreach($invoice['Data']['Payment'] as $payment){
                                    @if($payment->PaymentName == $invoice['PaymentType'])
                                        <option value="{{$payment->PaymentName}}" selected="selected">{{$payment->PaymentName}}</option>
                                    @else
                                    <option value="{{$payment->PaymentName}}">{{$payment->PaymentName}}</option>
                                    @endif
                                }
                                @endforeach
                            </select>
                        </div>
                    </div>  
                </div>
        </div>
    </div>

    <br>
    <span hidden>{{$subtotal = 0}}</span>
    <div class="table">
        <table>
            <tr>
                <th id="item">Item</th>
                <th id="weight">Weight(Kg)</th>
                <th id="qty">QTY</th>
                <th id="price">Unit Price</th>
                <th id="total">Total</th>
            </tr>
            @foreach($invoice['Product'] as $product)
                <span hidden>{{$subtotal = $subtotal + $product->Price * $product->Qty}}</span>
                <tr>
                    <td>{{$product->ProductName}}</td>
                    <td>{{$product->Weight}}</td>
                    <td>{{$product->Qty}}</td>
                    <td>{{$product->Price}}</td>
                    <td>{{$product->Price * $product->Qty}}</td>
                </tr>
            @endforeach
        </table>
    </div>
    <br>
    <div class="summary">
        <div>
            <div class="label"><label for="">Sub Total</label></div>
            <div class="num"><span>{{$subtotal}}</span></div>
        </div>
        <div>
            <div class="label"><label for="">Courier Fee</label></div>
            <div class="num"><span>{{$invoice['CourierFee']}}</span></div>
        </div>

        <div class="total">
            <div class="label"><label for="">Total</label></div>
            <div class="num"><span>{{$subtotal + $invoice['CourierFee']}}</span></div>
        </div>
    </div>
    <br>                       
    <input type="submit" id="btnSave" value="SAVE">
    </form> 
</body>
</html>