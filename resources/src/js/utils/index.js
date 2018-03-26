// UTILS
// Utility/Helper methods



function updateForm(field, data, parent) {
  if (parent) {
    this.form[parent][field] = data;
  } else {
    this.form[field] = data;
  }
}


export {
  updateForm,
};
