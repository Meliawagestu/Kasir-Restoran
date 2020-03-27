@extends('layouts.frontend')
@section('content')
<!-- contact -->
  <section id="Contact" class="Contact mb-5">
    <div class="container">
      <div class="row pt-4 mb-4">
        <div class="col text-center">
          <h2>Contact Us</h2>
        </div>
      </div>

      <div class="row justify-content-center">
        <div class="col-lg-4">
          <div class="card text-white bg-primary mb-3 text-center" style="max-width: 18rem;">
            <div class="card-body">
            <h5 class="card-title">Contact Us</h5>
            <p class="card-text">Lorem ipsum dolorsitamet,consectetur adipisicing elit,seddoeiusmod</p>
            </div>
          </div>
          <ul class="list-group">
            <li class="list-group-item"><h1>Location</h1></li>
            <li class="list-group-item">My Office</li>
            <li class="list-group-item">Jl Pangandaran</li>
            <li class="list-group-item">West Java Indonesia</li>
            
          </ul>
        </div>

        <div class="col-lg-6">
                    <form>
            <div class="form-group">
              <label for="nama">nama</label>
              <input type="text" class="form-control" id="nama" placeholder="Example input">
            </div>
            <div class="form-group">
              <label for="email">email</label>
              <input type="text" class="form-control" id="email" placeholder="Example input">
            </div>
            <div class="form-group">
              <label for="pesan">pesan</label>
              <textarea name="pesan" id="pesan" class="form-control"></textarea>
            </div>
            <div class="form-group">
              <button type="button" class="btn btn-primary">kirim pesan!</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
@endsection