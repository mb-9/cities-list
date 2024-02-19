



@extends('layouts.app')

@section('content')




    <div class="container p-5 text-center">
        <h1 class="fw-light"> Detail obce</h1>
        <div class="row justify-content-center mt-3 shadow detail-box">

        <div class="col-sm-6 bg-light">

                <table class="table mt-3 text-start">

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
                           <td>{{ $city->web_address}}</td>
                       </tr>

                   </tbody>
               </table>

        </div>

            <div class="col-sm-6 align-items-center">
                <div class="row align-items-center h-100 ">
                    <div>

                        <a href="{{ $city->web_address }}" class="link-big">{{ $city->name }}</a>
                    </div>
                </div>
            </div>


        </div>

    </div>



@endsection


