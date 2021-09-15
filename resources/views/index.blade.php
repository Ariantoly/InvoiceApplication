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
            <input type="text" name="no" id="no" value="{{old('no')}}">
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
            <form action="">
                @csrf
                <div class="left">
                    <div>
                        <div><label for="date">Invoice Date</label></div>
                        <div><input type="text" name="date" id="date" value="dd/MM/yyyy"></div>
                    </div>
                    <br>
                    <div>
                        <div><label for="to">To</label></div>
                        <div><textarea name="to" id="to" cols="30" rows="6"></textarea></div>
                    </div>
                    <br>
                    <div>
                        <div><label for="salesName">Sales Name</label></div>
                        <div>
                            <select name="sales" id="sales">
                                
                            </select>
                        </div>
                    </div>
                    <br>
                    <div>
                        <div><label for="courier">Courier</label></div>
                        <div>
                            <select name="courier" id="courier">
                                
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="right">
                    <div>
                        <div><label for="shipTo">Ship To</label></div>
                        <div><textarea name="shipTo" id="shipTo" cols="30" rows="6"></textarea></div>
                    </div>
                    <br>
                    <div>
                        <div><label for="payment">Payment Type</label></div>
                        <div>
                            <select name="payment" id="payment">
                                
                            </select>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <br>

    <div class="table">
        <table>
            <tr>
                <th id="item">Item</th>
                <th id="weight">Weight(Kg)</th>
                <th id="qty">QTY</th>
                <th id="price">Unit Price</th>
                <th id="total">Total</th>
            </tr>
            
        </table>
    </div>
    <br>
    <div class="summary">
        <div>
            <div class="label"><label for="">Sub Total</label></div>
            <div class="num"><span>0</span></div>
        </div>
        <div>
            <div class="label"><label for="">Courier Fee</label></div>
            <div class="num"><span>0</span></div>
        </div>

        <div class="total">
            <div class="label"><label for="">Total</label></div>
            <div class="num"><span>0</span></div>
        </div>
    </div>
    <br>
    <button type="submit" id="btnSave">SAVE</button>

</body>
</html>