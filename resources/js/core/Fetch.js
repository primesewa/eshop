
class Fetch{
    constructor()
    {
        this.fetchs=[];
        this.pagination ={};
        this.message='';
    }

    Get(requestType, url)
    {

        axios[requestType](url)
            .then(
                this.record.bind(this)
            );
    }
    record(fetch)
    {
        this.fetchs = fetch.data.data;
        if(fetch.data.meta){
            this.makepagination(fetch);
        }
        if(fetch.data.message)
        {
            this.makemessage(fetch);

        }

    }
    makemessage(message){

        this.message= message.data.message;
    }
    getmessage()
    {
        return this.message;
    }
    makepagination(page)
    {

        let pagination = {
            current_page : page.data.meta.current_page,
            last_page_url : page.data.meta.last_page,
            next_page_url : page.data.links.next,
            prev_page_url : page.data.links.prev
        }

        this. pagination =  pagination;


    }
    getpagination()
    {
        return this.pagination;
    }

    get(){

        return this.fetchs;
    }
    count()
    {
        return this.fetchs.length;
    }

}
export default Fetch;
