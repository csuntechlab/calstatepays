// MAJORS GETTERS

export default {
    majorData: state => index => state.majorCards[index].majorData,
    industries: state => index => state.majorCards[index].industries,
    educationLevel: state => index => state.majorCards[index].educationLevel,

    majorCards: state => state.majorCards,
    majorsByField: state => index => state.majorCards[index].majorsByField,
    formWasSubmitted:state=> index => state.majorCards[index].formWasSubmitted,
    formWasSubmittedOnce: state => index => state.majorCards[index].submittedOnce,
    majorIsLoading: state => index => state.majorCards[index].majorIsLoading,
    indexOfUnsubmittedCard: state => {
        // let bool = state.majorCards.every((el) => {
        //     return el.formWasSubmitted === true;
        // });
        let index = state.majorCards.findIndex((el) => {
            return el.formWasSubmitted === false;
        })
        return index;
    }
}