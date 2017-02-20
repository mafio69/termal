 <div class="modal fade" id="edit{{$loop->index}}" tabindex="-1" role="dialog"
                                     aria-labelledby="edit">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                                            aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title"
                                                    id="myModalLabel">Edycja wpisu zdarzenia</h4>
                                            </div>
                                            <div class="modal-body clearfix">
                                                <form action="{{url('/zdarzenie/edit/'.$event->id)}}" method="Post">
                                                    {{ csrf_field() }}

                                                    <label ><input type="radio"
                                                                                       {{ $event->activ == null ? 'checked' :'' }} value=""
                                                                                       name="activ">Aktywne</label>
                                                    <label ><input type="radio"
                                                                                       {{ $event->activ != null ? 'checked' :'' }} value="1"
                                                                                       name="activ">Zakończone</label>
                                                    <textarea type="text" name="description" class="form-control">{{$event->description }}
                                                            </textarea>
                                                     <input placeholder="RRRR-MM-DD" value="{{dzien($event->event_data) }}"  class="form-control" required type="date" name="date">
                                                     <input placeholder="GG:MM" value="{{ godzina($event->event_data) }}" class="form-control" required type="time" name="time">
                                                             
                                                    <hr>
                                                    <div class="pull-right">
                                                    <input type="submit" data-target="edit{{$loop->index}}"
                                                           class="btn btn-default " value="Zapisz zmiany">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
