class RequestController
{
    public function index()
    {
        echo "Request List";
    }

    public function show(int $id)
    {
        echo "Request Details";
    }

    public function updateStatus(int $id)
    {
        echo "Status Updated";
    }
}