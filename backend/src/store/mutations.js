export function setToken(state,token){
    state.user.token = token;
    if (token){
        sessionStorage.setItem('TOKEN',token);
    }else {
        sessionStorage.removeItem('TOKEN');
    }
}
export function setCurrentUser(state,user){
    state.user.data = user;
}

export function setUsers(state,[loading,response = null]){
    if (response){
        state.users = {
            ...state.users,
            data: response.data,
            links:response.meta.links,
            total:response.meta.total,
            limit:response.meta.per_page,
            from:response.meta.from,
            to:response.meta.to,
            page:response.meta.current_page,
        }
    }
    state.products.loading = loading;
}


export function setCustomers(state,[loading,response = null]){
    if (response){
        state.customers = {
            ...state.customers,
            data: response.data,
            links:response.meta.links,
            total:response.meta.total,
            limit:response.meta.per_page,
            from:response.meta.from,
            to:response.meta.to,
            page:response.meta.current_page,
        }
    }
    state.products.loading = loading;
}

export function setProducts(state,[loading,response = null]){
    if (response){
        state.products = {
            ...state.products,
            data: response.data,
            links:response.meta.links,
            total:response.meta.total,
            limit:response.meta.per_page,
            from:response.meta.from,
            to:response.meta.to,
            page:response.meta.current_page,
        }
    }
        state.products.loading = loading;
}

export function setOrders(state,[loading,response = null]){
    if (response){
        state.orders = {
            ...state.orders,
            data: response.data,
            links:response.meta.links,
            total:response.meta.total,
            limit:response.meta.per_page,
            from:response.meta.from,
            to:response.meta.to,
            page:response.meta.current_page,
        }
    }
        state.orders.loading = loading;
}
