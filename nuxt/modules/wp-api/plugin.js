import WPApi from 'wpapi'

/**
 * Routes
 */
import registerFrontPage from '~/modules/wp-api/routes/front-page'
import registerMenu from '~/modules/wp-api/routes/menu'
import registerSlug from '~/modules/wp-api/routes/slug'
import registerCPT from '~/modules/wp-api/routes/cpt'
import registerCustomFields from '~/modules/wp-api/routes/custom-fields'

const wp = new WPApi(<%= serialize(options) %>)

export default (ctx, inject) => {
  /**
   * Register routes
   */
   registerFrontPage(wp)
   registerMenu(wp)
   registerSlug(wp)
   registerCPT(wp)

   registerCustomFields(wp)

  /**
   * Inject
   */
  inject('wp', wp)
}
