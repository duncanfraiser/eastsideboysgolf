<!-- Enter Shot Modal -->
<div class="modal fade" id='boyShot' tabindex="-1" role="dialog" aria-labelledby="addGolferModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      {!!Form::open(['action' => 'ShotController@store'])!!}
        <div class="modal-header">
          <h5 class="modal-title" id="addGolferModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div style="margin:15px">
                <input type="hidden" name="boyId" id="hiddenBoyId">
                <input type="hidden" name="boyDay" id="hiddenBoyDay">
                <input type="text" class="form-control" placeholder="Score" name="total" required>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
          {!!Form::submit('Add Score',['class'=>'btn btn-success btn-sm'])!!}
        </div>
      {!!Form::close()!!}
    </div>
  </div>
</div>
