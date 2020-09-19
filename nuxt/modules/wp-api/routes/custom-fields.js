export default wp =>
  (wp.custom_fields = wp.registerRoute('wuxt/v1', '/custom_fields/(?P<name>)', {
    params: ['embed']
  }))
