<!-- create new Boys  Modal -->
<div class="modal fade" id="addGolferModal" tabindex="-1" role="dialog" aria-labelledby="addGolferModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content green-back">
            {!!Form::open(['action' => 'BoyController@store'])!!}
                <div class="modal-header">
                    <p class="modal-title dayBoxHeader">Enter New Golfer</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div style="margin:15px">
                        <input type="text" class="form-control" placeholder="First Name" name="firstName" required>
                    </div>
                    <div style="margin:15px">
                        <input type="text" class="form-control" placeholder="Last Name" name="lastName" required>
                    </div>
                    <div style="margin: 0px 30px">
                        <div class="row">
                            <div class="column">
                                <p>{!!Form::checkbox('mon', 1, false,['class' => 'addBoyCheckbox'])!!} Monday</p>
                                <p>{!!Form::checkbox('wed', 1, false,['class' => 'addBoyCheckbox'])!!} Wednesday</p>
                            </div>
                            <div class="column">
                                <p>{!!Form::checkbox('fri', 1, false,['class' => 'addBoyCheckbox'])!!} Friday</p>
                                <p>{!!Form::checkbox('out', 1, false,['class' => 'addBoyCheckbox'])!!} Outing</p>
                            </div>
                            <div class="column">
                                <p>{!!Form::checkbox('ptp', 1, false,['class' => 'addBoyCheckbox'])!!} Play-To-Play</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Close</button>
                    {!!Form::submit('Add Golfer',['class'=>'btn btn-primary btn-sm'])!!}
                </div>
            {!!Form::close()!!}
        </div>
    </div>
</div>
