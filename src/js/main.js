console.clear()

const apolloClient = new Apollo.lib.ApolloClient({
  networkInterface: Apollo.lib.createNetworkInterface({
  	// Edit: https://launchpad.graphql.com/nnnwvmq07
    uri: 'https://api.github.com/graphql',
    transportBatching: true,
  }),
  connectToDevTools: true,
})

const apolloProvider = new VueApollo.ApolloProvider({
  defaultClient: apolloClient,
})

const ISSUES_QUERY = Apollo.gql`
{
  repository(owner:"dev-night", name:"talks") {
    issues(last:20, states:OPEN) {
      edges {
        node {
          title
          url
          assignees(first:100) {
            edges {
              node {
                avatarUrl
                name
                email
                url
                login
              }
            }
          }
          reactions(first:100) {
            edges {
              node {
                content
              }
            }
          }
          labels(first:10) {
            edges {
              node {
                name
                color
              }
            }
          }
        }
      }
    }
  }
}
`

// New VueJS instance
const app = new Vue({
  // CSS selector of the root DOM element
  el: '#app',
  data: {
  	posts: [],
    loading: 0,
  },
  // Apollo GraphQL
  apolloProvider,
  apollo: {
    issues: {
    	query: ISSUES_QUERY,
      loadingKey: 'loading',
    },
  },
})
