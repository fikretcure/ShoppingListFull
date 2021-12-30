<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
    const request = async (method, v, url, data) => {
        let resp = null;

        switch (method) {
            case "POST":
                resp = await axios({
                    method: method,
                    url: "{{ route('home') }}" + '/api/' + v + '/' + url,
                    data: data,
                    headers: {
                        'x-refresh-token': localStorage.getItem("x-refresh-token"),
                        'x-access-token': localStorage.getItem("x-access-token"),
                    }
                });
                break;
            case "GET":
                resp = await axios({
                    method: method,
                    url: "{{ route('home') }}" + '/api/' + v + '/' + url,
                    params: data,
                    headers: {
                        'x-refresh-token': localStorage.getItem("x-refresh-token"),
                        'x-access-token': localStorage.getItem("x-access-token"),
                    }
                });
                break;
            default:
                break;
        }
        return new Promise(function(resolve, reject) {
            localStorage.setItem('x-access-token', resp.headers["x-access-token"]);
            switch (resp.status) {
                case 200:
                    resolve(resp);
                    break;
                default:
                    reject(reject);
                    break;
            }
        });
    };
    $(".exit").click(function() {
        localStorage.setItem('x-access-token', null);
        localStorage.setItem('x-refresh-token', null);
        window.location.href = "/login";
    });
</script>
