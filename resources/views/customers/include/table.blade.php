<div class="table-responsive">
    <table class="table footable">
        <tr><th>Firma</th><th data-breakpoints="xs sm md" >Status</th><th data-breakpoints="xs sm">Miasto</th><th data-breakpoints="xs" >Telefon</th><th data-breakpoints="sm xs" >Email</th><th data-breakpoints="xs sm">WWW</th><th data-breakpoints="xs" >Akcja</th></tr>
        @foreach($customers as $customer)
            @if($customer->id !== 55)


                <tr data-expanded="true">
                    <td>
                        <a href="{{url('/klienci/'.$customer->id)}}" class="link-grey" title="Pokaż">{{$customer->company}}</a>
                    </td>
                    <td>
                        {{$customer->status->name}}
                    </td>
                    <td>
                        {{$customer->city}}
                    </td>
                    <td>
                        {{$customer->phone_1}}
                    </td>
                    <td>
                        {{$customer->email}}
                    </td>
                    <td>

                        @if(!empty($customer->web))
                            <a href="http://{{$customer->web}}" title="Wejdż na strone klienta" target="_blank">Strona klienta</a>
                        @endif
                    </td>
                    <td>
                        <div class="dropdown ">
                            <button class="btn btn-default dropdown-toggle btn-sm" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                Menu
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                                <li><a href="{{url('/zdarzenie-dodaj/'.$customer->id)}}" title="Dodaj zdarzenie"><i class="fa fa-plus" aria-hidden="true"></i> Dodaj zdarzenie</a></li>
                                <li><a href="{{url('/klienci/'.$customer->id)}}" title="Pokaż"><i class="fa fa-eye" aria-hidden="true"></i> Pokaż</a></li>
                                <li> <a href="{{url('/osoba/'.$customer->id.'/create')}}" title="Dodaj osobę kontaktową."  ><i class="fa fa-user" aria-hidden="true"></i> Dodaj osobę kontaktową</a></li>
                                @if($notes->contains('customer_id',$customer->id))
                                    <li><a href="{{url('/notes/'.$customer->id.'/list')}}" title="Pokaż" ><i class="fa fa-eye" aria-hidden="true"></i> Pokaż notatki</a></li>
                                @endif
                                <li><a href="{{url('/notes/'.$customer->id).'/create'}}" title="Notatka"><i class="fa fa-plus" aria-hidden="true"></i>
                                        Dodaj notatkę</a></li>
                                <li><a class="bg-warning" href="{{ url('/klienci/'.$customer->id)}}/edit"><i class="fa fa-pencil" aria-hidden="true"></i> Edytuj</a></li>
                            </ul>
                        </div>


                    </td>
                </tr>



            @endif
        @endforeach

    </table>
</div>