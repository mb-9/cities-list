



@extends('layouts.app')

@section('content')




    <div class="container p-5" style="text-align: center">
        <h1 > Detail obce</h1>
        <div class="row justify-content-center mt-3 shadow detail-box">

        <div class="col-sm-6" style="text-align:center">



                <table class="table mt-3" style="text-align:left">

                   <tbody>

                       <tr>
                           <td><b>Meno starostu:</b></td>
                           <td>{{ $city->mayor_name }}</td>
                       </tr>
                       <tr>
                           <td><b>Adresa obecného úradu:</b></td>
                           <td>{{ $city->name }}</td>
                       </tr>
                       <tr>
                           <td><b>Telefón:</b></td>
                           <td>{{ $city->phone }}</td>
                       </tr>
                       <tr>
                           <td><b>Fax:</b></td>
                           <td>{{ $city->fax }}</td>
                       </tr>
                       <tr>
                           <td><b>Email:</b></td>
                           <td>{{ $city->email  }}</td>
                       </tr>
                       <tr>
                           <td><b>Web:</b></td>
                           <td> <a href="{{ $city->web_address  }}">{{ $city->web_address}}</a></td>
                       </tr>

                   </tbody>
               </table>

        </div>

            <div class="col-sm-6 align-items-center">
                <div class="row align-items-center" style="height:100%" >
                    <div>

                        <a href="{{ $city->web_address }}" class="link-big">{{ $city->name }}</a>
                    </div>
                </div>
            </div>


        </div>

    </div>



@endsection


