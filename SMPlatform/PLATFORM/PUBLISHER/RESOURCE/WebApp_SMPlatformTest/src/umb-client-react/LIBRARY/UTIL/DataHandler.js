/**
 * 数据处理工具类
 */
export class DataHandler {
    /**
     * 获取指定分割符的最后一个片段
     * @param delimiter
     * @param string
     * @returns {T}
     */
    static lastSegment( delimiter, string ) {
        let explode_array = string.split( delimiter ).reverse();
        let res = explode_array[ 0 ];
        return res;
    }

    /**
     * json2html
     * @param json
     * @param is_colorful
     * @returns {string}
     */
    static jsonToHtml( json, is_colorful = true ) {
        let res = JSON.stringify( json, null, 4 );
        res = res.replace( /[\n\r]/g, '<br/>' );
        res = res.replace( /\s/g, '&nbsp;' );
        if ( is_colorful === true ) {
            res = res.replace( /true/g, '<span style="color:blue">true</span>' );
            res = res.replace( /false/g, '<span style="color:red">false</span>' );
            res = res.replace( /null/g, '<span style="color:red">null</span>' );
            res = res.replace( /:&nbsp;(\d+)/g, ': <span style="color:blue">$1</span>' );
        }
        return res;
    }
}