
<section class="contact_us_bg">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="breedcrumb text-center">
          <ul>
            <li><a href="#">Pewnyparking</a></li>
            <li><a href="#">Contacts</a></li>
          </ul>
          <h2>Contact us</h2>
        </div>
      </div>
    </div>
  </div>
    </section>
    <div class="clearfix"></div>
    <section class="info">
      <div class="container">
        <div class="info_inr">
        <div class="row">
          <div class="col-md-5">
            <div class="general_info">
              <h4>general inquiries</h4>
            </div>
            <div class="general_inq_main">
            <div class="Gen_inq">
              <div class="gen_icn">
                <i class="fa fa-phone" aria-hidden="true"></i>
              </div>
              <div class="gen_txt">
                <p>+8801756698213</p>
                <p>8801936489655</p>
              </div>
            </div>
            
            <div class="Gen_inq">
              <div class="gen_icn">
                <i class="fa fa-envelope" aria-hidden="true"></i>
              </div>
              <div class="gen_txt">
                <p>Pnwnyparking12@gmail.com</p>
                <p>www.pewnyparking.com</p>
              </div>
            </div>
            <div class="Gen_inq">
              <div class="gen_icn">
                <i class="fa fa-home" aria-hidden="true"></i>
              </div>
              <div class="gen_txt">
                <p>+8801756698213</p>
                <p>8801936489655</p>
              </div>
            </div>
          </div>
          </div>
          <div class="col-md-7">
            <form>
            <div class="general_info">
              <h4>request information</h4>
            </div>

            <div class="gener_frm">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                <input type="text" class="form-control" id="name" placeholder="Your Name" name="email">
              </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                <input type="text" class="form-control" id="name" placeholder="Your Email" name="email">
                </div>
                  </div>
                  
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <textarea rows="5" placeholder="Your Message"></textarea>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <div class="input-group image-preview">
                <input type="text" class="form-control image-preview-filename"> <!-- don't give a name === doesn't send on POST/GET -->
                <span class="input-group-btn">
                    <!-- image-preview-clear button -->
                    <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                        <span class="glyphicon glyphicon-remove"></span> Clear
                    </button>
                    <!-- image-preview-input -->
                    <div class="btn btn-default image-preview-input">
                        <span class="glyphicon glyphicon-folder-open"></span>
                        <span class="image-preview-input-title">Choose File</span>
                        <input type="file" accept="image/png, image/jpeg, image/gif" name="input-file-preview"/> <!-- rename it -->
                    </div>
                </span>
                
            </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="sbt_btn">
                      <input type="button" name="" class="sbmt_btn" value="submit"></div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          
          </div>
        </div>
        </div>
    </section>
    <section class="map">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3680.148344453071!2d75.88488231492776!3d22.722726985105673!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3962fd4b09bfe885%3A0x3d265575f7a4e0ec!2sMactosys+Software+Solution+Pvt.+Ltd.!5e0!3m2!1sen!2sin!4v1540982663013" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
    </section>
        <script type="text/javascript">
     $(document).on('click', '#close-preview', function(){ 
    $('.image-preview').popover('hide');
    // Hover befor close the preview    
});

$(function() {
    // Create the close button
    var closebtn = $('<button/>', {
        type:"button",
        text: 'x',
        id: 'close-preview',
        style: 'font-size: initial;',
    });
    closebtn.attr("class","close pull-right");

    // Clear event
    $('.image-preview-clear').click(function(){
        $('.image-preview').attr("data-content","").popover('hide');
        $('.image-preview-filename').val("");
        $('.image-preview-clear').hide();
        $('.image-preview-input input:file').val("");
        $(".image-preview-input-title").text("Browse"); 
    }); 
    // Create the preview image
    $(".image-preview-input input:file").change(function (){     
        var img = $('<img/>', {
            id: 'dynamic',
            width:250,
            height:200
        });      
        var file = this.files[0];
        var reader = new FileReader();
        // Set preview image into the popover data-content
        reader.onload = function (e) {
            $(".image-preview-input-title").text("Change");
            $(".image-preview-clear").show();
            $(".image-preview-filename").val(file.name);
        }        
        reader.readAsDataURL(file);
    });  
});                       
</script>
