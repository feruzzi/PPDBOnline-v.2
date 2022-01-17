@extends('layouts/main-layout')
@section('title',"$title")
@section('content')
<div class="container content">
    @if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{session('success')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @elseif(session()->has('update'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        {{session('update')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @elseif(session()->has('delete'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{session('delete')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
     @endif
    <div class="text-center">
        <h1>Profil Sekolah</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat, rerum in nemo tempora illum consequatur aliquid voluptatum quis, ex nisi vitae facilis iste nam deserunt nulla. Eum, asperiores ut? Facere?
            Quam, fugit quasi laudantium vitae est quisquam voluptatibus molestias error placeat. Saepe et illum voluptatibus velit optio, laboriosam magni dicta sequi quam quae a ea? Ipsum a repudiandae deserunt cumque.
            At aliquam repudiandae itaque error atque laboriosam facilis quasi, quo nam ipsa eius possimus corporis accusamus maxime voluptas vitae provident sapiente. Veritatis temporibus doloribus incidunt iure nihil ipsam in aliquam.
            Suscipit cumque expedita assumenda, ab hic nihil non vitae dolor quibusdam animi quidem odit harum asperiores aut repudiandae ducimus recusandae rem et sit sed deleniti! Nihil nulla dicta praesentium veniam.
            Corrupti minima architecto aspernatur perspiciatis fugit, necessitatibus vero dolor voluptatibus blanditiis cum vel maiores vitae placeat quas, harum error recusandae quae nam. Tempora, deserunt quod delectus recusandae animi cumque consequuntur?
            Modi autem maxime, et in, dolore aut distinctio veniam numquam accusamus quis nulla, dignissimos facere nesciunt aperiam magni quaerat ad explicabo. Laborum eius maxime aliquam voluptatem quos optio eum enim.
            Deleniti, perspiciatis. Numquam exercitationem accusantium, itaque sit minima aut officiis aspernatur omnis corporis enim eligendi neque sequi vitae mollitia cupiditate eius accusamus, id a culpa similique expedita ipsum! Incidunt, tempore?
            Atque inventore consequatur eveniet quidem maxime, eum eius, minima est eligendi deleniti et at dolorem quaerat delectus dignissimos optio. Commodi in minus explicabo molestias reiciendis. Quasi molestias perferendis esse totam.
            Magni culpa incidunt aut corrupti enim perspiciatis dolorum vero atque temporibus? Fuga mollitia commodi dolores ratione magni, nobis architecto quod soluta iste et eius laborum doloremque explicabo, aliquid deleniti sint!
            Nulla consequuntur velit sit minus omnis quasi rem aspernatur! Eligendi deserunt at eaque vero repellendus, atque a dolor? Fugiat odit sequi error totam libero unde sapiente, dolorum suscipit enim magnam.</p>
            <h1>Visi dan Misi</h1>
            <ul>
                <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas tempora nihil cupiditate magnam pariatur aut aliquid voluptate deserunt impedit temporibus, incidunt maxime sapiente inventore, nostrum quas quos nobis accusamus cum!</li>
                <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas tempora nihil cupiditate magnam pariatur aut aliquid voluptate deserunt impedit temporibus, incidunt maxime sapiente inventore, nostrum quas quos nobis accusamus cum!</li>
                <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas tempora nihil cupiditate magnam pariatur aut aliquid voluptate deserunt impedit temporibus, incidunt maxime sapiente inventore, nostrum quas quos nobis accusamus cum!</li>
                <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas tempora nihil cupiditate magnam pariatur aut aliquid voluptate deserunt impedit temporibus, incidunt maxime sapiente inventore, nostrum quas quos nobis accusamus cum!</li>
            </ul>
            <hr>
            <h1>Lainnya</h1>
        </div>
</div>
@endsection