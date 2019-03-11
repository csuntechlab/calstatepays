// PFRE STATE

// everything in the state needs to be initially set to 0.

export default {
    pfreFormWasSubmitted: false,
    pfreDisciplineLoad: false,
	pfreShowInfo: false,
    pfreInfoKey: null,
    pfreMajorsByField: [],
    pfreIsLoading: false,
	pfreSelected: {},
	pfreData: {
		id: null,
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
			actual: 0
		},
		returnOnInvestment: {
			minimum: 0,
			average: 0.075,
			maximum: 0.15,
			actual: 0
		}
	}
};

