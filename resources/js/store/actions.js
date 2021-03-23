import axios from "axios";

let actions = {
    // Send a get request to our /api/search endpoints to get our products
    // this action is dispatched whenever the user is searching for something
    SEARCH_TAREAS({commit}, query) {
        let params = {
            query
        };

        axios.get(`/api/search`, {params}).then(res => {
            if (res.data === "ok") {
                console.log("Request sent successfully");
            }
        }).catch(err => {
            console.log(err);
        });
    },
    // Make a get request to our api/tareas endpoint to get our database tareas
    // and commits the request result with SET_TAREAS mutation.
    GET_TAREAS({commit}) {
        axios.get("/api/tareas").then(res => {
            {
                commit("SET_TAREAS", res.data)
            }
        }).catch(err => {
            console.log(err);
        });
    }
}

export default actions;
