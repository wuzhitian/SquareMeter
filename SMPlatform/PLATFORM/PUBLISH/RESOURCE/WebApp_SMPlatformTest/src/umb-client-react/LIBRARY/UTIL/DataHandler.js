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
}