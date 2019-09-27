import Vue from 'vue'
import axios from 'axios'


//import sweetalert library
import VueSweetalert2 from 'vue-sweetalert2';

//use sweetalert
Vue.use(VueSweetalert2);

new Vue({
  el:'#dw',
  data: {
    chemicals : {
      id:'',
      name:'',
      formula:'',
    },

    elenmeyer: {
      chemicals_id:'',
      qty: 1
    },
    shoppingCart: [],
    submitCart: false,
    activity: {
      name: ''
    },
    formActivity: false,
    resultStatus: false,
    submitForm: false,
    errorMessage: '',

  },
  watch: {
    //if value from chemicals id change
    'chemicals.id': function() {
      //check if change value of chemical > id

        if (this.chemicals.id) {
          //run methods getChemicals

          this.getChemicals()
        }
    },
    'activity.name': function() {
      this.formActivity = false
        if (this.activity.name != '') {
          this.activity = {
                name: '',
                description: ''
          }
        }
    },
  },
  //use library select2 on file loaded
  mounted() {
    $('#chemicals_id').select2({
        width: '100%'
    }).on('change', () => {
    //if chnage value so selet value of selected
    // save on var id
        this.chemicals.id = $('#chemicals_id').val();
    });
    //call method getelmayer
    this.getElenmeyer()
  },
  methods: {
    getChemicals() {
      //fetch to server using axios vue with parameter id
      //with url /api/chemicals/{id}
      axios.get(`/api/chemicals/${this.chemicals.id}`)
      .then((response) => {
        //assing data from server to var chemicals
        this.chemicals = response.data
      })
    },
    addToElenmeyer() {
      this.submitCart = true;

      axios.post('/api/elenmeyer', this.elenmeyer)
            .then((response) => {
                setTimeout(() => {
                    console.log(response.data);
                    this.shoppingCart = response.data
                    this.elenmeyer.chemicals_id = ''
                    this.elenmeyer.qty = 1
                    this.chemicals = {
                        id: '',
                        name: '',
                        formula: ''
                    }
                    $('#chemicals_id').val('')
                    this.submitCart = false
                }, 2000)
            })
            .catch((error) => {

            })
    },
    //take list rlmeyer alrady save
    getElenmeyer() {
      //fetch data to server
      axios.get('/api/elenmeyer')
      .then((response) => {
        //data from response save to var shoppingCart
        this.shoppingCart = response.data
        console.log(this.shoppingCart);
      })
    },
    //search kegiatan
    searchActivity() {
      axios.post('/api/activity/search', {
        name: this.activity.name
      }).then((response) => {
        if (response.data.status == 'success') {
            this.activity = response.data.data
            this.resultStatus = true
          }
        this.formActivity = true}).catch((error) => { })
    },
    // method sendAnalysis() kita biarkan kosong terlebih dahulu, section selanjutnya akan di modifikasi
    sendAnalysis() {
      //Mengosongkan var errorMessage dan message
      this.errorMessage = ''
      this.message = ''

      //jika var customer.email dan kawan-kawannya tidak kosong
      if (this.activity.name != '' && this.customer.description != '' ) {
      //maka akan menampilkan kotak dialog konfirmasi
          this.$swal({
            title: 'Kamu Yakin?',
              text: 'Kamu Tidak Dapat Mengembalikan Tindakan Ini!',
              type: 'warning',
              showCancelButton: true,
              confirmButtonText: 'Iya, Lanjutkan!',
              cancelButtonText: 'Tidak, Batalkan!',
              showCloseButton: true,
              showLoaderOnConfirm: true,
              preConfirm: () => {
                return new Promise((resolve) => {
                    setTimeout(() => {
                        resolve()
                        }, 2000)
                    })
                },
              allowOutsideClick: () => !this.$swal.isLoading()
              }).then ((result) => {
            //jika di setujui
              if (result.value) {
                //maka submitForm akan di-set menjadi true sehingga menciptakan efek loading
                  this.submitForm = true
                  //mengirimkan data dengan uri /checkout
                  axios.post('/checkout', this.activity)
                  .then((response) => {
                    setTimeout(() => {
                          //jika responsenya berhasil, maka cart di-reload
                          this.getElenmeyer();
                          //message di-set untuk ditampilkan
                          this.message = response.data.message
                          //form customer dikosongkan
                          this.customer = {
                            name: '',
                            description: '',
                          }
                          //submitForm kembali di-set menjadi false
                          this.submitForm = false
                        }, 1000)
                    }).catch((error) => {
                    console.log(error)
                    })
                }
            })
        } else {
        //jika form kosong, maka error message ditampilkan
          this.errorMessage = 'Masih ada inputan yang kosong!'
        }
    },
    //remove elenmeyer
    removeElenmeyer(id) {
      //display confirm using sweetalert
      this.$swal({
        title: 'Kamu Yakin?',
        text: 'kamu Tidak Dapat mengembalikan Ini!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Iya, lanjutkan!',
        cancelButtonText: 'Tidak, Batalkan!',
        showCloseButton: true,
        showLoaderOnConfirm: true,
        preConfirm: () => {
          return new Promise((resolve) => {
            setTimeout(() => {
              resolve()
            }, 2000)
          })
        },
      allowOutsideClick: () => !this.$swal.isLoading()
      }).then ((result) => {
        //if aprove
        if (result.value) {
          //send data to server
          axios.delete(`/api/elenmeyer/${id}`)
          .then ((response) => {
              //load new elenmeyer
              console.log(response);
              this.getElenmeyer();
          })
          .catc ((error) => {
            console.log(error);
          })
        }
      })
    }
  }//end method
});
Vue.config.devtools = true;
