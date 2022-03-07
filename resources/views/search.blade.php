<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>

    <title>{{$title}}</title>

    <script>

function CreatePDFfromHTML() {
    var HTML_Width = $(".accordion").width();
    var HTML_Height = $(".accordion").height();
    var top_left_margin = 15;
    var PDF_Width = HTML_Width + (top_left_margin * 2);
    var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
    var canvas_image_width = HTML_Width;
    var canvas_image_height = HTML_Height;

    var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

    html2canvas($(".accordion")[0]).then(function (canvas) {
        var imgData = canvas.toDataURL("image/jpeg", 1.0);
        var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
        pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
        for (var i = 1; i <= totalPDFPages; i++) { 
            pdf.addPage(PDF_Width, PDF_Height);
            pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
        }
        pdf.save("records.pdf");
        //$(".accordion").hide();
    });
}


    </script>
  </head>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
  <a class="navbar-brand" href="#"> @if ( Session::has('USER_NAME') ) Welcome  {{ Session::get('USER_NAME')}} @endif</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">@if ( Session::has('USER_NAME') )
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{url('logout')}}">Logout</a>
        </li>
        @endif
        
      </ul> 
     
    </div>
  </div>
</nav>
  <body>
  

<div class="container">
<!-- Gutter g-1 -->
<form action="{{url('search')}}" method="get" >
   
<div class="row g-1" style="margin-top:20px;">
  <div class="col-8">
    <!-- Name input -->
    <div class="form-outline">
      <input type="text" id="form9Example1" name="search" class="form-control" placeholder="Search Here" />
     
    </div>
  </div>
  <div class="col-4">
    <!-- Email input -->
    <div class="form-outline">
      <input type="submit" id="form9Example2" name="search_sub" class="form-control" value="Search" />
      
    </div>
  </div>
</div>
</form>
@if(isset($data->items[0]))
<div class="accordion" id="accordionExample" style="margin-top:30px;margin-bottom:70px;">
<?php $i=1; $f = new NumberFormatter("en", NumberFormatter::SPELLOUT); ?>
@foreach( $data->items as $item )

  <div class="accordion-item">
    <h2 class="accordion-header" id="heading{{ucfirst($f->format($i))}}">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ucfirst($f->format($i))}}" aria-expanded="true" aria-controls="collapse{{ucfirst($f->format($i))}}">
        {{$item->title}}
      </button>
    </h2>

    <div id="collapse{{ucfirst($f->format($i))}}" class="accordion-collapse collapse <?php if($i===1) { echo "show"; }?>" aria-labelledby="heading{{ucfirst($f->format($i))}}" data-bs-parent="#accordionExample">
    
    
    <div class="accordion-body"><div class="row">
   
    <div class="col-12">
      <strong>{{$item->title}}</strong> {{$item->snippet}}
      &nbsp;&nbsp;<a href="{{$item->link}}" target="_blank" class="">Read More</a>
    </div>

    
      </div>
    </div>


    </div>
    
  </div>

<?php $i++; ?>
@endforeach

</div>
<a href="javascript:void(0)" onclick="CreatePDFfromHTML()" class="btn btn-primary" >Save as Pdf</a>
@endif
</div>


 

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>