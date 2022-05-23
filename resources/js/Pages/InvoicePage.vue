<template>
  <div>
    <div class="row">
      <div class="col-md-12">
        <table class="table table-striped table-sm-responsive">
          <thead class="thead-inverse">
            <tr>
              <th>designation</th>
              <th>Quantité</th>
              <th>Prix unitaire</th>
              <th>Montant</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in selectedItems" :key="item.id">
              <td>
                <div class="form-group">
                  <input
                    type="text"
                    v-model="item.designation"
                    class="form-control"
                    name="designation[]"
                    id=""
                    aria-describedby="helpId"
                    placeholder=""
                  />
                </div>
              </td>
              <td>
                <div class="form-group">
                  <input
                    type="number"
                    v-model="item.quantity"
                    class="form-control"
                    name="quantity[]"
                    id=""
                    aria-describedby="helpId"
                    placeholder=""
                  />
                </div>
              </td>
              <td>
                <div class="form-group">
                  <input
                    type="number"
                    v-model="item.unitPrice"
                    class="form-control"
                    name="unit_price[]"
                    id=""
                    aria-describedby="helpId"
                    placeholder=""
                  />
                </div>
              </td>
              <td>
                <strong> {{ montant(index) }} </strong>
              </td>
              <td>
                <button
                  type="button"
                  @click="removeItem(index)"
                  class="btn btn-clean btn-sm"
                >
                  <i class="fa fa-trash"></i>
                </button>
              </td>
            </tr>

            <tr>
              <td colspan="5">
                <button
                  type="button"
                  name=""
                  id=""
                  class="btn btn-primary"
                  @click="addItem"
                >
                  Add item
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 offset-md-6 bg-secondary border-1 ">
        <table class="table">
          <thead>
            <tr>
              <th>Designation</th>
              <th>Value</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td scope="row">TVA</td>
              <td>
                <div class="form-group">
                  <input
                    type="text"
                    class="form-control"
                    v-model="tva"
                    name="tva"
                    id=""
                    aria-describedby="helpId"
                    placeholder=""
                  />
                </div>
              </td>
            </tr>
            <tr>
              <td scope="row">SubTotal</td>
              <td>{{ subTotal }}</td>
            </tr>
            <tr>
              <td scope="row">Total</td>
              <td>{{ total }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>



<script>
export default {
  data: () => {
    return {
      tva: 17,
      selectedItems: [],
      availableFormation: [],
      availableEvents: [],
    };
  },
  computed: {
    subTotal() {
      let total = 0;
      this.selectedItems.forEach((element) => {
        total += element.quantity * element.unitPrice;
      });
      return total;
    },
    total() {
      return Math.round(
        (this.subTotal * this.tva) / 100 + this.subTotal
      ).toFixed(2);
    },
  },
  methods: {
    montant(index) {
      return this.selectedItems[index].quantity;
    },
    addItem() {
      this.selectedItems.push({
        id: Math.random(),
        designation: null,
        quantity: 1,
        unitPrice: 0.0,
        selectedFormation: null,
        selectedEvent: null,
      });
    },
    removeItem(index) {
      this.selectedItems.splice(index, 1);
      // console.log(id);
      // this.selectedItems = this.selectedItems.filter(
      //   (element) => (element.id = id)
      // );
    },
  },
};
</script>