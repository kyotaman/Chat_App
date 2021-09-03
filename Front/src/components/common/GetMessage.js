import {axios, moment} from '../../router/index'

const GetMessages = (url) => {
  axios.get(url)
    .then((res) => {
      return res.data
    })
}

export default GetMessages
