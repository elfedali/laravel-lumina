 @if (session('success'))
     <div class="alert bg-success text-white  text-center alert-dismissible fade show" role="alert">
         {{ session('success') }}
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
     </div>
 @endif

 @if (session('error'))
     <div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
         {{ session('error') }}
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
     </div>
 @endif
 @if (session('warning'))
     <div class="alert alert-warning text-center  alert-dismissible fade show" role="alert">
         {{ session('warning') }}
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
     </div>
 @endif
 @if (session('info'))
     <div class="alert alert-info text-center  alert-dismissible fade show" role="alert">
         {{ session('info') }}
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
     </div>
 @endif

 @if ($errors->any())
     <div class="alert alert-dark  text-center alert-dismissible fade show" role="alert">
         <strong>
             Errors
         </strong>
         <ol class="mb-0">
             @foreach ($errors->all() as $error)
                 <li>{{ $error }}</li>
             @endforeach
         </ol>
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
     </div>
 @endif
