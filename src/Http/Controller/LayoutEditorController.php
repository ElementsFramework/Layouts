<?php


namespace ElementsFramework\Layout\Http\Controller;



use ElementsFramework\Layout\Model\Layout;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

/**
 * Class LayoutEditorController
 * @package ElementsFramework\Layout\Http\Controller
 */
class LayoutEditorController extends Controller
{

    /**
     * @param $id
     * @return $this
     */
    public function getEditorForLayout($id)
    {
        $layout = Layout::findOrFail($id);

        return view('LayoutBuilder::builder')
            ->with('layout', $layout);
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function saveLayout(Request $request, $id)
    {
        $layout = Layout::findOrFail($id);
        $layout->content = $request->getContent();
        $layout->save();

        return response()->json(['success' => 'true']);
    }

}