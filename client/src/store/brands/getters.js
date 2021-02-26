export default {
  options: (state) => {
    let options = [];
    state.data.forEach((value) => {
      options.push({ key: value.id, value: value.name });
    });
    return options;
  },
};
