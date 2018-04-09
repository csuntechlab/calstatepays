// FILTERS

import numeral from 'numeral';

const percentage = data => numeral(data).format('0.00%');
const currency = data => numeral(data).format('$0,0');

export {
    percentage,
    currency
}