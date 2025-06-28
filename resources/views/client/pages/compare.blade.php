@extends('client.client_master')
@section('title', 'Compare | Premium Refined Luxury Homes')
@section('main')
 <!-- breadcrumb start -->
 <section class="breadcrumb-section p-0">
    <img src="https://themes.pixelstrap.com/sheltos/assets/images/inner-background.jpg" class="bg-img img-fluid" alt="">
    <div class="container">
        <div class="breadcrumb-content">
            <div>
                <h2>Property Compare</h2>
                <nav aria-label="breadcrumb" class="theme-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Compare</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Property Compare</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- breadcrumb end -->

<!-- property grid start -->
<section class="compare-section">
    <div class="container">
        <div class="compare-page">
            <div class="table-wrapper table-responsive">
                <table class="table">
                    <thead>
                        <tr class="th-compare">
                            <td>Action</td>
                            <th class="item-row">
                                <button type="button" class="remove">Remove</button>
                            </th>
                            <th class="item-row">
                                <button type="button" class="remove">Remove</button>
                            </th>
                            <th class="item-row">
                                <button type="button" class="remove">Remove</button>
                            </th>
                            <th class="item-row">
                                <button type="button" class="remove">Remove</button>
                            </th>
                        </tr>
                    </thead>
                    <tbody id="table-compare">
                        <tr>
                            <th class="property-name">Property Image</th>
                            <td class="item-row">
                                <img src="https://themes.pixelstrap.com/sheltos/assets/images/property/2.jpg" alt="" class="featured-image">
                                <div class="property_price">
                                    <h6 class="color-2">
                                        <a href="single-property-8.html">Home in Merrick Way</a>  
                                    </h6>
                                    <span class="color-2">$8689,00</span>
                                </div>
                            </td>
                            <td class="item-row">
                                <img src="https://themes.pixelstrap.com/sheltos/assets/images/property/4.jpg" alt="" class="featured-image">
                                <div class="property_price">
                                    <h6 class="color-2">
                                        <a href="single-property-8.html">Hidden Spring Hideway</a> 
                                    </h6>
                                    <span class="color-2">$6649,00</span>
                                </div>
                            </td>
                            <td class="item-row">
                                <img src="https://themes.pixelstrap.com/sheltos/assets/images/property/10.jpg" alt="" class="featured-image">
                                <div class="property_price">
                                    <h6 class="color-2">
                                        <a href="single-property-8.html">Little Acorn Farm</a>  
                                    </h6>
                                    <span class="color-2">$5530,00</span>
                                </div>
                            </td>
                            <td class="item-row">
                                <img src="https://themes.pixelstrap.com/sheltos/assets/images/property/12.jpg" alt="" class="featured-image">
                                <div class="property_price">
                                    <h6 class="color-2">
                                        <a href="single-property-8.html">Allen's Across Way</a>
                                    </h6>
                                    <span class="color-2">$4870,00</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="property-name">Property Description</th>
                            <td class="item-row">
                                <p class="description-compare">The most common and most absolute type of estate, the tenant enjoys the greatest discretion over the disposal of the property.</p>
                            </td>
                            <td class="item-row">
                                <p class="description-compare">Elegant retreat in a quiet Coral Gables setting. This home provides wonderful entertaining spaces with a chef
                                    kitchen opening…</p>
                            </td>
                            <td class="item-row">
                                <p class="description-compare">An interior designer is someone who plans, researches,coordinates, management and manages such enhancement projects.</p>
                            </td>
                            <td class="item-row">
                                <p class="description-compare">Real estate is divided into several categories, including residential property, commercial property and industrial property.</p>
                            </td>
                        </tr>
                        <tr>
                            <th class="property-name">Bedroom</th>
                            <td>
                                <span>3</span>
                            </td>
                            <td>
                                <span>4</span>
                            </td>
                            <td>
                                <span>2</span>
                            </td>
                            <td>
                                <span>1</span>
                            </td>
                        </tr>
                        <tr>
                            <th class="property-name">Bathroom</th>
                            <td>
                                <span>4</span>
                            </td>
                            <td>
                                <span>3</span>
                            </td>
                            <td>
                                <span>3</span>
                            </td>
                            <td>
                                <span>2</span>
                            </td>
                        </tr>
                        <tr>
                            <th class="property-name">Sq Ft.</th>
                            <td>
                                <span>8000</span>
                            </td>
                            <td>
                                <span>5000</span>
                            </td>
                            <td>
                                <span>4000</span>
                            </td>
                            <td>
                                <span>2000</span>
                            </td>
                        </tr>
                        <tr>
                            <th class="property-name">Location</th>
                            <td>
                                <span>USA</span>
                            </td>
                            <td>
                                <span>France</span>
                            </td>
                            <td>
                                <span>Brazil</span>
                            </td>
                            <td>
                                <span>Germany</span>
                            </td>
                        </tr>
                        <tr>
                            <th class="property-name">Available</th>
                            <td>
                                <span class="f-w-600">On Rent</span>
                            </td>
                            <td>
                                <span class="f-w-600">On Sell</span>
                            </td>
                            <td>
                                <span class="f-w-600">No Fees</span>
                            </td>
                            <td>
                                <span class="f-w-600">On Rent</span>
                            </td>
                        </tr>
                        <tr>
                            <th class="property-name">Wishlist</th>
                            <td class="available-stock">
                                <button onclick="document.location='user-favourites.html'" class="add-to-wish btn btn-gradient color-2 btn-block btn-pill">Add to wishlist</button>
                            </td>
                            <td class="available-stock">
                                <button onclick="document.location='user-favourites.html'" class="add-to-wish btn theme color-2 btn-block btn-pill">Add to wishlist</button>
                            </td>
                            <td class="available-stock">
                                <button onclick="document.location='user-favourites.html'" class="add-to-wish btn btn-gradient color-2 btn-block btn-pill">Add to wishlist</button>
                            </td>
                            <td class="available-stock">
                                <button onclick="document.location='user-favourites.html'" class="add-to-wish btn btn-gradient color-2 btn-block btn-pill">Add to wishlist</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<!-- property grid end -->
@endsection