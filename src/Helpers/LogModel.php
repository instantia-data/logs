<?php


namespace Logs\Helpers;

/**
 *
 * @author luispinto
 */
trait LogModel
{
    
    
    public function arrayChanges($model)
    {
        $arr = [];
        
        foreach($model->getDirty() as $col=>$value){
            if($col == 'updated_at'){
                continue;
            }
            $str = $col . ': FROM ';
            if(isset($model->getOriginal()[$col])){
                $str .= $model->getOriginal()[$col];
            }
            $arr[] = $str . ' TO ' . $value; 
        }
        if(count($arr) > 0){
            return implode(' | ', $arr);
        }
        return null;
        
    }
    
    public function arrayAttributes($model)
    {
        $arr = [];
        foreach($model->toArray() as $col=>$value){
            if($col == 'id'){
                continue;
            }
            $arr[] = $col . ': ' . $value; 
        }
        if(count($arr) > 0){
            return implode(' | ', $arr);
        }
        return null;
    }
}
