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
    <div class="col-4">
          @if(isset($item->pagemap->cse_image[0]))
      <img src="{{$item->pagemap->cse_image[0]->src}}" height="200" width="200">
        @endif  
    </div>
    <div class="col-8">
      <strong>{{$item->title}}</strong> {{$item->snippet}}
      <a href="{{$item->link}}" target="_blank" class="">Read More</a>
    </div>

    
      </div>
    </div>


    </div>
    
  </div>

<?php $i++; ?>
@endforeach

</div>
<a href="{{url('download')}}" class="btn btn-primary" >Save as Pdf</a>
@endif