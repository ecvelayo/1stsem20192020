@extends('layouts.template')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">



            <div class="container">
                <div class="card">
                    <div class="card-header">
                        Order Code:
                        <strong>EH_OC-IqnJL</strong>
                        <span class="float-right"> <strong>Status:</strong> Pending</span>


                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-sm-6">
                                <h6 class="mb-3">From:</h6>
                                <div>
                                    <strong>eHarvest</strong>
                                </div>
                                <div>Gov. M. Cuenco Ave, Cebu City, 6000 Cebu</div>
                                <div>Site: eharvest.ph</div>
                                <div>Email: eharvest@gmail.com</div>
                                <div>Phone: +639 98312 8845</div>

                                <div>Order Code: 0FASF</div>

                            </div>

                            <div class="col-sm-6">
                                <h6 class="mb-3">To:</h6>
                                <div>
                                    <strong>Bob Mart</strong>
                                </div>
                                <div>Attn: Daniel Marek</div>
                                <div>43-190 Mikolow, Poland</div>
                                <div>Email: marek@daniel.com</div>
                                <div>Phone: +639 98312 8845</div>
                            </div>



                        </div>

                        <div class="table-responsive-sm">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="center">#</th>
                                        <th>Product Name</th>
                                        <th>Price Per Unit</th>
                                        

                                        <th class="center">Qty</th>
                                        <th class="right">Total</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    <tr>
                                        <td class="center">1</td>
                                        <td class="left strong">Banana</td>
                                        <td class="left strong">₱100 / Kilogram</td>
                                        {{-- <td class="left">₱100 / Kilogram</td> --}}


                                        <td class="center">1</td>
                                        <td class="right">₱999,00</td>
                                    </tr>
                                    {{-- <tr>
                  <td class="center">2</td>
                  <td class="left">Custom Services</td>
                  <td class="left">Instalation and Customization (cost per hour)</td>
                  
                   
                    <td class="center">20</td>
                  <td class="right">₱3.000,00</td>
                  </tr>
                  <tr>
                  <td class="center">3</td>
                  <td class="left">Hosting</td>
                  <td class="left">1 year subcription</td>
                  
                   
                    <td class="center">1</td>
                  <td class="right">₱499,00</td>
                  </tr> --}}

                                </tbody>


                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-sm-5">

                            </div>

                            <div class="col-lg-4 col-sm-5 ml-auto">
                                <table class="table table-clear">
                                    <tbody>
                                        <tr>
                                            <td class="left">
                                                <strong>Subtotal</strong>
                                            </td>
                                            <td class="right">₱8.497,00</td>
                                        </tr>

                                        <tr>
                                            <td class="left">
                                                <strong>Delivery Fee</strong>
                                            </td>
                                            <td class="right">₱50</td>
                                        </tr>
                                        <tr>
                                            <td class="left">
                                                <strong>Grand Total</strong>
                                            </td>
                                            <td class="right">
                                                <strong>₱7.477,36</strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>

                        </div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-print"></i>Print Invoice</button>
                    </div>
                    
                </div>

                
            </div>





        </div>
    </div>
</div>





@endsection