// PFRE STATE

// everything in the state needs to be initially set to 0.

export default {
    pfreFormWasSubmitted: false,
    pfreShowInfo: false,
    pfreInfoKey: null,
    pfreData: {
        years: {
            start: 2,
            middle: 7,
            end: 12,
            actual: 0
        },
        earnings: {
            minimum: 20000,
            average: 50000,
            maximum: 100000,
            actual: 0,
        },
        returnOnInvestment: {
            minimum: 0,
            average: .075,
            maximum: .15,
            actual: 0,
        }
    },
};

