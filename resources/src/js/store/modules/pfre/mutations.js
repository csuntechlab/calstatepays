// PFRE MUTATIONS
import _pfre from '../../mutation-types/pfre';

export default {
    [_pfre.FETCH_MOCK_DATA](state) {
        state.pfreData.years.actual = Math.floor(Math.random() * Math.floor(13));
        state.pfreData.earnings.actual = Math.floor(Math.random() * Math.floor(45000));
        state.pfreData.returnOnInvestment.actual = (Math.random() * (0 - .15) + .15).toFixed(2);
    }
}
