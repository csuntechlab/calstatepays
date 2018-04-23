// PFRE ACTIONS
import _pfre from '../../mutation-types/pfre';

export default {

    fetchMockData({commit, dispatch}) {
        commit(_pfre.FETCH_MOCK_DATA);
    },
    toggleInfo({commit}, payload) {
        commit(_pfre.TOGGLE_INFO, payload);
    }
}