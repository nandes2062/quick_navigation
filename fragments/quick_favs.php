<?php
/**
 * This file is part of the Quick Navigation package.
 *
 * @author (c) Friends Of REDAXO
 * @author <friendsof@redaxo.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$drophistory = $date = $link = $where = '';
$user =  rex::getUser()->getId();
$datas = rex_addon::get('quick_navigation')->getConfig('quicknavi_favs'.$user);
if (count($datas)) {

	foreach ($datas as $data) {
			   if (rex_category::get($data)){
				   $cat = rex_category::get($data);
				   $catName = rex_escape($cat->getName());
				   $catId = rex_escape($cat->getId());
				   $attributes = [
						'href' => rex_url::backendPage('content/edit',
							[
								'page' => 'structure',
								'clang' => $this->clang,
								'category_id' => $data
							]
						)
					];
                    $addAttributes = [
                        'href' => rex_url::backendPage('structure',
                            [
                                'category_id' => $catId,
                                'clang' => $this->clang,
                                'function' => 'add_art'
                            ]
                        )
                    ];
					$link .= '<li class="quicknavi_left"><a ' . rex_string::buildAttributes($attributes) . ' title="' . $catName . '">' . $catName .'</a></li><li class="quicknavi_right"><a ' . rex_string::buildAttributes($addAttributes) . ' title="'. $this->i18n("title_favs") .' '.  $catName . '"><i class="fa fa-plus" aria-hidden="true"></i></a></li>';
			   }
			}	   
            
?>
                <div class="btn-group">
                    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <span class="caret"></span>
                    </button>
                    <ul class="quickfiles quicknavi dropdown-menu dropdown-menu-right">
                        <?= $link ?>
                    </ul>
                </div>
<?php                 
}
?>
