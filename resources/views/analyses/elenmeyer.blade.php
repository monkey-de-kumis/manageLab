<div class="col-md-4">
  @component('components.card')
    @slot('title')
      Elenmeyer
    @endslot

    <div class="table-responsive">
        <div>@{{ shoppingCart }}</div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Bahan</th>
                    <th>Rumus</th>
                    <th>Qty</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="(row, index) in shoppingCart">
                      <td>@{{ row.name }}</td>
                      <td>@{{ row.formula }}</td>
                      <td>@{{ row.qty }}</td>
                      <td>
                        <button
                            @click.prevent="removeElenmeyer(index)"
                            class="btn btn-danger btn-sm">
                            <i class="fa fa-trash"></i>
                        </button>
                      </td>
                </tr>
            </tbody>
        </table>
      </div>
        @slot('footer')
        <div class="card-footer text-muted">
          @if (url()->current() == route('analisa.kegiatan'))
            <a href="{{ route('analisa.checkout') }}"
              class="btn btn-info btn-sm float-right">
              <i class="fa fa-flask"></i>Analisa</a>
          @else
            <a href="{{ route('analisa.kegiatan') }}"
            class="btn btn-secondary btn-sm float-right"
            >Kembali</a>
          @endif
        </div>
        @endslot
    @endcomponent
  </div>
