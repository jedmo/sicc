<div class="col-xxl-4 mb-25">

    <div class="card border-0 px-25">
      <div class="card-header px-0 border-0">
        <h6>Próximos eventos</h6>
      </div>
      <div class="card-body p-0">
        <div class="tab-content">
          <div class="tab-pane fade active show" id="t_selling-today" role="tabpanel" aria-labelledby="t_selling-today-tab">
            <div class="selling-table-wrap">
              <div class="table-responsive">
                <table class="table table--default table-borderless ">
                  <thead>
                    <tr>
                      <th>Evento</th>
                      <th>Fecha</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($last_week_data['events'] as $event)
                    <tr>
                      <td>
                        <div class="selling-product-img d-flex align-items-center">
                          <img class="radius-xs img-fluid order-bg-opacity-primary" src="{{ asset('assets/img/'.$event->image) }}" alt="img">
                          <span>{{ $event->name }}</span>
                        </img>
                      </td>
                      <td>{{ Carbon\Carbon::parse($event->start_date)->format('d-M-Y') }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="t_selling-week" role="tabpanel" aria-labelledby="t_selling-week-tab">
            <div class="selling-table-wrap">
              <div class="table-responsive">
                <table class="table table--default table-borderless">
                  <thead>
                    <tr>
                      <th>PRDUCTS NAME</th>
                      <th>Price</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <div class="selling-product-img d-flex align-items-center">
                          <img class="me-15 wh-34 img-fluid order-bg-opacity-primary" src="{{ asset('assets/img/287.png') }}" alt="img">
                          <span>Samsung Galaxy S8 256GB</span>
                        </div>
                      </td>
                      <td>$60,258</td>
                    </tr>
                    <tr>
                      <td>
                        <div class="selling-product-img d-flex align-items-center">
                          <img class="me-15 wh-34 img-fluid" src="{{ asset('assets/img/165.png') }}" alt="img">
                          <span>Half Sleeve Shirt</span>
                        </div>
                      </td>
                      <td>$2,483</td>
                    </tr>
                    <tr>
                      <td>
                        <div class="selling-product-img d-flex align-items-center">
                          <img class="me-15 wh-34 img-fluid order-bg-opacity-primary" src="{{ asset('assets/img/166.png') }}" alt="img">
                          <span>Marco Shoes</span>
                        </div>
                      </td>
                      <td>$19,758</td>
                    </tr>
                    <tr>
                      <td>
                        <div class="selling-product-img d-flex align-items-center">
                          <img class="me-15 wh-34 img-fluid order-bg-opacity-primary" src="{{ asset('assets/img/315.png') }}" alt="img">
                          <span>15" Mackbook Pro</span>
                        </div>
                      </td>
                      <td>$197,458</td>
                    </tr>
                    <tr>
                      <td>
                        <div class="selling-product-img d-flex align-items-center">
                          <img class="me-15 wh-34 img-fluid order-bg-opacity-primary" src="{{ asset('assets/img/506.png') }}" alt="img">
                          <span>Apple iPhone X</span>
                        </div>
                      </td>
                      <td>115,254</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="t_selling-month" role="tabpanel" aria-labelledby="t_selling-month-tab">
            <div class="selling-table-wrap">
              <div class="table-responsive">
                <table class="table table--default table-borderless">
                  <thead>
                    <tr>
                      <th>PRDUCTS NAME</th>
                      <th>Price</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <div class="selling-product-img d-flex align-items-center">
                          <img class="me-15 wh-34 img-fluid order-bg-opacity-primary" src="{{ asset('assets/img/287.png') }}" alt="img">
                          <span>Samsung Galaxy S8 256GB</span>
                        </div>
                      </td>
                      <td>$60,258</td>
                    </tr>
                    <tr>
                      <td>
                        <div class="selling-product-img d-flex align-items-center">
                          <img class="me-15 wh-34 img-fluid" src="{{ asset('assets/img/165.png') }}" alt="img">
                          <span>Half Sleeve Shirt</span>
                        </div>
                      </td>
                      <td>$2,483</td>
                    </tr>
                    <tr>
                      <td>
                        <div class="selling-product-img d-flex align-items-center">
                          <img class="me-15 wh-34 img-fluid order-bg-opacity-primary" src="{{ asset('assets/img/166.png') }}" alt="img">
                          <span>Marco Shoes</span>
                        </div>
                      </td>
                      <td>$19,758</td>
                    </tr>
                    <tr>
                      <td>
                        <div class="selling-product-img d-flex align-items-center">
                          <img class="me-15 wh-34 img-fluid order-bg-opacity-primary" src="{{ asset('assets/img/315.png') }}" alt="img">
                          <span>15" Mackbook Pro</span>
                        </div>
                      </td>
                      <td>$197,458</td>
                    </tr>
                    <tr>
                      <td>
                        <div class="selling-product-img d-flex align-items-center">
                          <img class="me-15 wh-34 img-fluid order-bg-opacity-primary" src="{{ asset('assets/img/506.png') }}" alt="img">
                          <span>Apple iPhone X</span>
                        </div>
                      </td>
                      <td>115,254</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
