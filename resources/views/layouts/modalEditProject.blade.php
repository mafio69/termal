 <div class="modal fade" id="editProject{{$project->id}}" tabindex="-1" role="dialog"
                                     aria-labelledby="edit">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                                            aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title"
                                                    id="myModalLabel">Edycja wpisu Projektu</h4>
                                            </div>
                                            <div class="modal-body clearfix">
                                                <form action="{{url('/projekt/'.$project->id)}}" method="Post">
                                                    {{ csrf_field() }}
                                                    {{method_field('put')}}

                                                    <label ><input type="radio"
                                                                                       {{ $project->not_activ == null ? 'checked' :'' }} value=""
                                                                                       name="not_activ">Aktywne</label>
                                                    <label ><input type="radio"
                                                                                       {{ $project->not_activ != null ? 'checked' :'' }} value="1"
                                                                                       name="not_activ">Zakończone</label>
                                                    <hr>
                                                    <input type="text" class="form-control" required name="title" value="{{$project->title}}">
                                                    <hr>
                                                    <textarea type="text" name="description" required class="form-control">{{$project->description }}
                                                            </textarea>

                                                    <hr>
                                                    <div class="pull-right">
                                                    <input type="submit" class="btn btn-default " value="Zapisz zmiany">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
