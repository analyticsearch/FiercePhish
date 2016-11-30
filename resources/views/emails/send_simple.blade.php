@extends('layouts.app')

@section('content')
<div class="page-title">
  <div class="title_left">
    <h3>Send Single Email</h3>
  </div>
</div>

<div class="clearfix"></div>

<div class="row">
  <div class="col-md-6 col-sm-6 col-xs-6">
    <div class="x_panel">
      <div class="x_content">
          <form class="form-horizontal form-label-left input_mask">

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Sender Name <span class="required">*</span></label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" id="sender_name" name="sender_name" class="form-control" placeholder="Bill Smith">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Sender Email <span class="required">*</span></label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="email" id="sender_email" name="sender_email" class="form-control" placeholder="bsmith@malicious.com">
                </div>
              </div>
              <div class="ln_solid"></div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Receiver Name <span class="required">*</span></label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" id="receiver_name" name="receiver_name" class="form-control" placeholder="John Doe">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Receiver Email <span class="required">*</span></label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="email" id="receiver_email" name="receiver_email" class="form-control" placeholder="john.doe@domain.com">
                </div>
              </div>
              <!--<div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                  <button type="submit" class="btn btn-primary">Cancel</button>
                  <button type="submit" class="btn btn-success">Submit</button>
                </div>
              </div>
                -->
            </form>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-sm-6 col-xs-6">
    <div class="x_panel">
      <div class="x_content">
          <form class="form-horizontal form-label-left input_mask">

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Attachment</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <label class="btn btn-primary" for="attachment">
                    <input type="file" id="attachment" name="attachment" style="display: none;" onchange="$('#upload-file-info').html($(this).val())">
                    Browse...
                  </label>
                  <span class="label label-info" id="upload-file-info"></span>
                </div>
              </div>
              <div class="form-group date">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Send TLS?</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                    <div class="radio">
                        <label>
                            <input type="radio" id="sendTLS" name="sendTLS" value="yes" checked /> Yes
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="sendTLS" value="no" /> No
                        </label>
                    </div>
                </div>
              </div>
            </form>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
    <form class="form-horizontal form-label-left input_mask">
      <div class="form-group">
        <label class="control-label col-md-1 col-sm-1 col-xs-1">Subject <span class="required">*</span></label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <input type="text" id="subject" name="subject" class="form-control" placeholder="Subject...">
        </div>
      </div>

      <textarea rows="10" id="bodyMsg" name="bodyMsg" class="bodyMsg"></textarea>
    </form>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <form id="send_email_form" class="form-horizontal form-label-left input_mask" action="{{ action('EmailController@send_simple_post') }}" method="post">
        {{ csrf_field() }}
        <div style="text-align: center;">
          <button class="btn btn-success" style="margin-right: 30px;">Send email</button>
          <a class="btn btn-danger" style="margin-left: 30px;" href="">Cancel</a>
          <input type="hidden" name="sbt_sender_name" id="sbt_sender_name">
          <input type="hidden" name="sbt_sender_email" id="sbt_sender_email">
          <input type="hidden" name="sbt_receiver_name" id="sbt_receiver_name">
          <input type="hidden" name="sbt_receiver_email" id="sbt_receiver_email">
          <input type="hidden" name="sbt_attachment" id="sbt_attachment">
          <input type="hidden" name="sbt_sendTLS" id="sbt_sendTLS">
          <input type="hidden" name="sbt_subject" id="sbt_subject">
          <input type="hidden" name="sbt_message" id="sbt_message">
        </div>
      </form>
    </div>
  </div>
</div>
@endsection



@section('footer')
<script type="text/javascript">
/* global $ */
    CKEDITOR.replace('bodyMsg');

    $("#send_email_form").submit(function() {
      var vars = ['sender_name', 'sender_email', 'receiver_name', 'receiver_email', 'attachment', 'sendTLS', 'subject'];
      for (var x=0; x< vars.length; ++x)
      {
        $("#sbt_"+vars[x]).val($("#"+vars[x]).val());
      }
      $("#sbt_message").val(CKEDITOR.instances.bodyMsg.getData());

      var check_to_submit = {'sender_name': "Sender Name", 'sender_email': "Sender Email", 'receiver_name': "Receiver Name", 'receiver_email': "Receiver Email", 'sendTLS': 'TLS Option', 'subject': 'Subject', 'message': 'Email Body'};
      var to_check = Object.keys(check_to_submit);

      for (var x=0; x<to_check.length; ++x)
      {
        if ($("#sbt_"+to_check[x]).val() == "")
        {
          bootbox.alert(check_to_submit[to_check[x]] + " is required!");
          return false;
        }
      }
      return true;
    });
</script>
@endsection