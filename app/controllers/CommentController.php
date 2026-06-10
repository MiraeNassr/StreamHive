class CommentController {
private $commentModel;

public function __construct($commentModel) {
$this->commentModel = $commentModel;
}
}